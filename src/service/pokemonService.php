<?php

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonService
{
    private $pokeApiUrl = 'http://pokeapi.co/api/v2/';

    /**
     * @var HttpClientInterface
     */
    private $client;


    /**
     * PokemonService constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(httpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getPokeApiUrl(): string
    {
        return $this->pokeApiUrl;
    }

    public function getPokemonById($id)
    {

            $response = $this->client->request(
                'GET',
                $this->getPokeApiUrl() . 'pokemon/' . $id
            );

        return $response->toArray();


    }
}
