<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [], $queryParam = [], $body="")
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYmYiOjE2NDg0ODk4NDksImV4cCI6MTY0ODUwMDY1MCwiaXNzIjoickN6OFNuM0dHWG1pa0gyTWRUZUdZMUQ3MTFFT1JYIiwiYXVkIjoickN6OFNuM0dHWG1pa0gyTWRUZUdZMUQ3MTFFT1JYIiwidXNlcklkIjoiMSIsInVzZXJOYW1lIjoianBlcmV6IiwiZW1haWxBZGRyZXNzIjoianBlcmV6QGRvbWFpbi5jb20iLCJjdXN0b21lcnMiOlt7ImlkIjoxLCJuYW1lIjoiSmVmZmVyZXkgVG9ycCJ9XSwicm9sZXMiOlt7ImlkIjoxLCJuYW1lIjoiQWRtaW4ifV0sInBlcm1pc3Npb25zIjpbeyJpZCI6MSwibmFtZSI6ImFkZEN1c3RvbWVyIn0seyJpZCI6MiwibmFtZSI6InNhdmVDdXN0b21lciJ9LHsiaWQiOjMsIm5hbWUiOiJhY2Nlc3NDdXN0b21lcnMifSx7ImlkIjo0LCJuYW1lIjoiYWRkQWNjb3VudCJ9LHsiaWQiOjUsIm5hbWUiOiJzYXZlQWNjb3VudCJ9LHsiaWQiOjYsIm5hbWUiOiJhY2Nlc3NBY2NvdW50cyJ9XSwiYWRkQ3VzdG9tZXIiOiJ0cnVlIiwic2F2ZUN1c3RvbWVyIjoidHJ1ZSIsImFjY2Vzc0N1c3RvbWVycyI6InRydWUiLCJhZGRBY2NvdW50IjoidHJ1ZSIsInNhdmVBY2NvdW50IjoidHJ1ZSIsImFjY2Vzc0FjY291bnRzIjoidHJ1ZSJ9.M3CNRAyLm9gyygiKNwF4ZkfTBeaDg8aouBW_flm5yv8';

        /*if (isset($this->basic)) {
            if (!empty($body)) {
                $headers['Content-Type'] = 'application/json';
            }
            $headers['Authorization'] = "Basic ".$this->basic;
        }*/
        if (!empty($body)) {
            $response = $client->request($method, $requestUrl, ['body' => $body, 'headers' => $headers]);
        }else {
            $response = $client->request($method, $requestUrl, ['form_params' => $formParams,'query' => $queryParam, 'headers' => $headers]);
        }

        return $response->getBody()->getContents();
    }
}
