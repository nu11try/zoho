<?php

class CurlClass
{
    private $curl;

    public function curlInitAndStart($url, $method, $fileds = null)
    {
        $this->curl = curl_init();

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $fileds);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Content-Length: " . strlen($fileds),
            "Authorization: Zoho-oauthtoken 1000.817958ead259426fb77f01d24f78edea.abec431ea7cb1848b6407652d83e54ab"
        ));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 60);

        $buf = curl_exec($this->curl);
        curl_close($this->curl);

        return $buf;
    }
}