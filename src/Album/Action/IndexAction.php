<?php

namespace App\Album\Action;

use App\Album\Service\AlbumServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class IndexAction
{
    /**
     * @var AlbumServiceInterface
     */
    protected $albumService;

    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;

    /**
     * @param Template\TemplateRendererInterface|null $template
     * @param AlbumServiceInterface $albumService
     */
    public function __construct(
        Template\TemplateRendererInterface $template = null,
        AlbumServiceInterface $albumService
    ) {
        $this->template = $template;
        $this->albumService = $albumService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $albums = $this->albumService->listAlbums();

        return new HtmlResponse($this->template->render('album::index', compact('albums')));
    }
}
