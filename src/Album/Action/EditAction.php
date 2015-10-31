<?php

namespace App\Album\Action;

use App\Album\Form\AlbumForm;
use App\Album\Service\AlbumServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class EditAction
{
    /**
     * @var AlbumServiceInterface
     */
    protected $albumService;

    /**
     * @var AlbumForm
     */
    protected $form;

    /**
     * @var Router\RouterInterface
     */
    protected $router;

    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;

    /**
     * @param Template\TemplateRendererInterface|null $template
     * @param AlbumServiceInterface $albumService
     */
    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        AlbumServiceInterface $albumService,
        AlbumForm $form
    ) {
        $this->router = $router;
        $this->template = $template;
        $this->albumService = $albumService;
        $this->form = $form;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {
            $id = $request->getAttribute('id');
            $album = $this->albumService->getAlbum($id);

            $this->form->bind($album);
            $this->form->get('submit')->setAttribute('value', 'Edit');

            if ($request->getMethod() === 'POST') {
                if ($this->albumService->updateAlbum($request->getParsedBody(), $id)) {
                    return new RedirectResponse($this->router->generateUri('album.index'));
                }
            }
        } catch (\Exception $e) {
            // perhaps log an error and display a message to the user
        }

        return new HtmlResponse($this->template->render('album::edit', [
            'form' => $this->form,
        ]));
    }
}
