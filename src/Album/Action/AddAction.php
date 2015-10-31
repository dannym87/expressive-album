<?php

namespace App\Album\Action;

use App\Album\Entity\Album;
use App\Album\Form\AlbumForm;
use App\Album\Service\AlbumServiceInterface;
use Aura\Session\Session;
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
     * @var AlbumForm
     */
    protected $form;

    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;

    /**
     * @param Router\RouterInterface $router
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
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {
            $this->form->get('submit')->setValue('Add');

            $album = new Album();
            $this->form->bind($album);

            if ($request->getMethod() === 'POST') {
                $this->albumService->addAlbum($request->getParsedBody());

                /**
                 * @var Session $session
                 */
                $session = $request->getAttribute('session');
                $session->getSegment('App\Album')->setFlash(
                    'flash',
                    [
                        'type'    => 'success',
                        'message' => sprintf('Successfully added album %s (%s)', $album->getTitle(),
                            $album->getArtist()),
                    ]
                );

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
