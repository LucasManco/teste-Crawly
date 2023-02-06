<?php

require "vendor/autoload.php";
require "src/Crawler.php";
require "src/DomUtility.php";

$crawler = new Crawler;
$domUtility = new DomUtility;

// Extrair valor do token
$xpath = '//input[@type="hidden"]/@value';
$tokenValues = $domUtility->extractData($crawler->get(), $xpath);
$token = $crawler->tokenDecrypt($tokenValues[0]->nodeValue);

// Enviar formulário e extrair respostas
$xpath = './/span[@id="answer"]';
$answerNodes = $domUtility->extractData($crawler->submitForm(["token" => $token]), $xpath);

// Exibir respostas
foreach ($answerNodes as $answer) {
    echo "Resposta = " . $answer->textContent . PHP_EOL;
}
