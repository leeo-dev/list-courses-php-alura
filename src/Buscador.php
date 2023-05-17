<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    /*
    *
    * @var ClientInterface
    */
        private $httpClient;
      /*
      *
      * @var Crawler
      */
        private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscaCursos(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);
        $html = $response->getBody();

        $crawler = new Crawler();
        $crawler->addHtmlContent($html);
        $elementosCursos = $crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach ($elementosCursos as $elementoCurso) {
            $cursos[] = $elementoCurso->textContent;
        }

        return $cursos;
    }
}
