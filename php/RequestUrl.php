<?php

class RequestUrl
{
    public function __construct() {
    }

    public function execute($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $responseLength = strlen($response);
        curl_close($ch);

        return [
            'url' => $url,
            'response_length' => $responseLength,
        ];
    }

    public function makeRequestByUrlArrays(array $randomUrls) {
        $arr = [];
        foreach ($randomUrls as $url) {
            $responseData = $this->execute($url);
            $arr [] = $responseData;
        }
        return $arr;
    }
}