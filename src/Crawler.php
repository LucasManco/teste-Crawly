<?php

class Crawler{
    protected string $url;

    protected  GuzzleHttp\Client $c;

    protected GuzzleHttp\Cookie\SessionCookieJar $jar;
    
    public function __construct($DESTINY_URL = "http://applicant-test.us-east-1.elasticbeanstalk.com/") {
        $this->url = $DESTINY_URL;
        $this->jar = new GuzzleHttp\Cookie\SessionCookieJar("CookieJar", true); 
        $this->c = new GuzzleHttp\Client(["cookies" => $this->jar]);
    }

    public function get(){
        $response = $this->c->get($this->url);
        return $response;
    }

    public function submitForm($form_params){
        $answer = $this->c->request("POST", $this->url, [
            "headers" => [
                "Pragma" => "no-cache",
        
                "Cache-Control" => "no-cache",
        
                "Upgrade-Insecure-Requests" => "1",
        
                "User-Agent" =>
                    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36",
        
                "Accept" =>
                    "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
        
                "Accept-Language" => "en-US,en;q=0.9",
        
                "Content-Type" => "application/x-www-form-urlencoded",
        
                "Origin" => $this->url,
        
                "Referer" => $this->url,
            ],
        
            "form_params" => $form_params,
        
            "cookies" => $this->getCookieJar(),
        
            "verify" => false,
        
            "allow_redirects" => false,
        ]);
        return $answer;
    }

    public function getClient(){
        return $this->c;
    }
    public function getCookieJar(){
        return $this->jar;
    }

    public function tokenDecrypt($encryptedToken){
        $replacements = [
            "0" => "9",        
            "1" => "8",        
            "2" => "7",        
            "3" => "6",        
            "4" => "5",        
            "5" => "4",        
            "6" => "3",        
            "7" => "2",        
            "8" => "1",        
            "9" => "0",        
            "a" => "z",        
            "b" => "y",        
            "c" => "x",        
            "d" => "w",        
            "e" => "v",        
            "f" => "u",        
            "g" => "t",        
            "h" => "s",        
            "i" => "r",        
            "j" => "q",        
            "k" => "p",        
            "l" => "o",        
            "m" => "n",        
            "n" => "m",        
            "o" => "l",        
            "p" => "k",        
            "q" => "j",        
            "r" => "i",        
            "s" => "h",        
            "t" => "g",        
            "u" => "f",        
            "v" => "e",        
            "w" => "d",        
            "x" => "c",        
            "y" => "b",        
            "z" => "a",
        ];
        
        $token = str_split($encryptedToken);
        
        for ($t = 0; $t < count($token); $t++) {
            if (array_key_exists($token[$t], $replacements)) {
                $token[$t] = $replacements[$token[$t]];
            }
        }
        
        $token = implode("", $token);

        return $token;
    }
}