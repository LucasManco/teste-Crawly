<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class CrawlerTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Crawler::class,
            new Crawler
        );
    }

    public function testInvalidUrl():void{
        $crawler = new Crawler('AAAAA');

        $this->expectException(GuzzleHttp\Exception\GuzzleException::class);
        $crawler->get();        
    }
    public function testDefaultUrl():void{
        $crawler = new Crawler();
        $answer = $crawler->get();      
        $this->assertEquals($answer->getStatusCode(), 200);        
    }
    public function testSubmitForm():void{
        $crawler = new Crawler();
        $domUtility = new DomUtility;


        // Extrair valor do token
        $xpath = '//input[@type="hidden"]/@value';
        $tokenValues = $domUtility->extractData($crawler->get(), $xpath);
        $token = $crawler->tokenDecrypt($tokenValues[0]->nodeValue);

        // Enviar formulário e extrair respostas
        $xpath = './/span[@id="answer"]';
        
        $answer = $crawler->submitForm(["token" => $token]);
        $this->assertEquals($answer->getStatusCode(), 200);    
    }


}