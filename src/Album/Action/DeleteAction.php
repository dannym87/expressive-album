<?php

namespace App\Album\Action;

use App\Album\Service\AlbumServiceInterface;
use Aura\Session\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Stdlib\Parameters;

class DeleteAction
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
     * @param Router\RouterInterface $router
     * @param Template\TemplateRendererInterface|null $template
     * @param AlbumServiceInterface $albumService
     */
    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        AlbumServiceInterface $albumService
    ) {
        $this->router = $router;
        $this->template = $template;
        $this->albumService = $albumService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {
            $album = $this->albumService->getAlbum($request->getAttribute('id'));

            if ($request->getMethod() === 'POST') {
                $body = new Parameters($request->getParsedBody());
                $del = $body->get('del', 'No');

                if (strtolower($del) === 'yes') {
                    $this->albumService->deleteAlbum($album);

                    /**
                     * @var Session $session
                     */
                    $session = $request->getAttribute('session');
                    $session->getSegment('App\Album')->setFlash(
                        'flash',
                        [
                            'type'    => 'success',
                            'message' => sprintf('Successfully deleted album %s (%s)', $album->getTitle(),
                                $album->getArtist()),
                        ]
                    );
                }

                // Redirect to list of albums
                return new RedirectResponse($this->router->generateUri('album.index'));
            }
        } catch (\Exception $e) {
            // do something useful
        }

        return new HtmlResponse($this->template->render('album::delete', compact('album')));
    }
}
