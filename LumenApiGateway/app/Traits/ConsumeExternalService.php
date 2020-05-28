<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Http\Response;
use function response;

trait ConsumeExternalService
{
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if(isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $reponse = $client->request($method, $requestUrl, [
            'form_params' => $formParams,
            'headers' => $headers
        ]);

        return $reponse->getBody()->getContents();
    }
}
