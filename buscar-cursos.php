#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use Alura\BuscadorDeCursos\Buscador;
use  GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

Teste::echoTeste();

$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscaCursos('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    exibeMensagem($curso);
}

//Aula Atual: https://cursos.alura.com.br/course/php-composer/task/56148
