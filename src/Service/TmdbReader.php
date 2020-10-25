<?php

namespace App\Service;

use GuzzleHttp\Client;

use App\Entity\Movie;

class TmdbReader
{
    private CONST BASE_URI = "https://api.themoviedb.org/3/";

    public function __construct($method)
    {
        $this->method = $method;
        $this->guzzleNewClient();
    }

    public function loadData()
    {
        switch($this->method) {
            case "lastMovies":
                $this->loadLastMovies();
            break;
        }
    }

    private function loadLastMovies()
    {
        try{
            $request = $this->guzzleClient->request("GET", "movie/latest?api_key=");
            if ($request->getStatusCode() == 200) {
                $json = $request->getBody();
                $arrayMovie = json_decode($json, true);
                
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    private function guzzleNewClient()
    {
        try{
            $this->guzzleClient = new Client(['base_uri' => self::BASE_URI]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}