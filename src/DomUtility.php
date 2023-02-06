<?php

class DomUtility{
    
    public static function extractData($response, $xpathstring){
        $htmlString = (string) $response->getBody();

        libxml_use_internal_errors(true);

        $doc = new DOMDocument();

        $doc->loadHTML($htmlString);

        $xpath = new DOMXPath($doc);

        $val = $xpath->query($xpathstring);

        return $val;
    }
}