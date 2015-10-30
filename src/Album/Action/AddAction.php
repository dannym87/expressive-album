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

class AddAction
{
    /**
     * @var AlbumServiceInterface
     */
    protected $albumService;

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
     * @param AlbumForm $form
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
     * @return HtmlResponse|RedirectResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {
            $this->form->get('submit')->setValue('Add');

            if ($request->getMethod() === 'POST') {
                $this->albumService->addAlbum($request->getParsedBody());

                return new RedirectResponse($this->router->generateUri('album.index'));
            }
        } catch (\Exception $e) {
            // perhaps log an error and display a message to the user
        }

        return new HtmlResponse($this->template->render('album::add', [
            'form' => $this->form,
        ]));
    }
}
