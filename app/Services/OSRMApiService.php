<?php


namespace App\Services;


use GuzzleHttp\Client;

class OSRMApiService
{
    protected $baseUrl = 'http://router.project-osrm.org/route/v1/driving/';

    /**
     * @param $url
     * @param $httpMethod
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getResult($url, $httpMethod)
    {
        $client = new Client();
        $apiRequest = $client->request($httpMethod, $this->baseUrl . $url);
        $response = $apiRequest->getBody()->getContents();
        return $response;
    }

    /**
     * @param $fromCoordinateX
     * @param $fromCoordinateY
     * @param $toCoordinateX
     * @param $toCoordinateY
     * @return mixed
     */
    public function getDrivingData($fromCoordinateX, $fromCoordinateY, $toCoordinateX, $toCoordinateY)
    {
        $response = null;
        $data = $this->getResult($fromCoordinateX . ',' . $fromCoordinateY . ';' . $toCoordinateX . ',' . $toCoordinateY, 'GET');

        if($data){
            $response = json_decode($data)->routes[0];
        }

        return $response;
    }

    /**
     * @param $fromCoordinateX
     * @param $fromCoordinateY
     * @param $toCoordinateX
     * @param $toCoordinateY
     * @return mixed
     */
    public function getDistance($fromCoordinateX, $fromCoordinateY, $toCoordinateX, $toCoordinateY)
    {
        $response = $this->getDrivingData($fromCoordinateX, $fromCoordinateY, $toCoordinateX,  $toCoordinateY);

        if(!$response){
            return false;
        }

        $distance = $response->distance;
        return $distance;
    }

    /**
     * @param $fromCoordinateX
     * @param $fromCoordinateY
     * @param $toCoordinateX
     * @param $toCoordinateY
     * @return mixed
     */
    public function getDuration($fromCoordinateX, $fromCoordinateY, $toCoordinateX, $toCoordinateY)
    {
        $response =  $this->getDrivingData($fromCoordinateX, $fromCoordinateY, $toCoordinateX,  $toCoordinateY);

        if(!$response){
            return false;
        }

        $duration = $response->duration;
        return $duration;
    }
}
