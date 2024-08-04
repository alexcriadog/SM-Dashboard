<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        // Define the base URL of the external API
        $this->baseUrl = 'https://run.mocky.io/v3/ab2f4b97-ea28-495b-b67a-36bc9805e153'; // Change this to your API URL
    }

    /**
     * Fetch followers data from the external API.
     *
     * @return array
     */
    public function getFollowers()
    {
        $response = Http::get("{$this->baseUrl}/followers"); // Adjust the endpoint as per your API

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to fetch followers data');
    }

    /**
     * Fetch interactions data from the external API.
     *
     * @return array
     */
    public function getInteractions()
    {
        $response = Http::get("{$this->baseUrl}/interactions"); // Adjust the endpoint as per your API

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to fetch interactions data');
    }

    /**
     * Fetch follower stats data from the external API.
     *
     * @return array
     */
    public function getFollowerStats()
    {
        $response = Http::get("{$this->baseUrl}/follower-stats"); // Adjust the endpoint as per your API

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to fetch follower stats data');
    }
}
