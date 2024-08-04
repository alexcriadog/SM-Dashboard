<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Follower;
use App\Models\FollowerStat;
use App\Models\Interaction;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ImportDataCommand extends Command
{
    protected $signature = 'import:data';
    protected $description = 'Import data from external API to the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apiUrl = 'https://run.mocky.io/v3/ab2f4b97-ea28-495b-b67a-36bc9805e153'; // Replace with your actual API URL

        try {
            // Fetch data from the external API
            $response = Http::get($apiUrl);

            // Check if the request was successful
            if (!$response->successful()) {
                throw new \Exception('Failed to fetch data from API: ' . $response->status());
            }

            $data = $response->json();

            foreach ($data as $item) {
                // Import or update follower data
                $follower = Follower::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'name' => $item['name'],
                        'age' => $item['age'],
                        'gender' => $item['gender'],
                        'country' => $item['country'],
                        'email' => $item['email'],
                        'phone' => $item['phone'],
                        'followers_count' => $item['followers']
                    ]
                );

                // Import or update follower stats
                FollowerStat::updateOrCreate(
                    [
                        'follower_id' => $follower->id,
                        'date_followed' => Carbon::parse($item['stats']['date_followed'])->format('Y-m-d') // Convert date to Y-m-d format
                    ],
                    [
                        'likes' => $item['stats']['likes'],
                        'comments' => $item['stats']['comments'],
                        'posts' => $item['stats']['posts'],
                        'engagement_rate' => $item['stats']['engagement_rate']
                    ]
                );

                // Import or update interactions
                foreach ($item['interactions'] as $interaction) {
                    // Convert timestamp to Y-m-d H:i:s format
                    $timestamp = Carbon::parse($interaction['timestamp'])->format('Y-m-d H:i:s');

                    Interaction::updateOrCreate(
                        [
                            'follower_id' => $follower->id,
                            'type' => $interaction['type'],
                            'timestamp' => $timestamp // Use the formatted timestamp
                        ],
                        [
                            'content' => $interaction['content']
                        ]
                    );
                }
            }

            $this->info('Data imported successfully.');
            return 0;
        } catch (\Exception $e) {
            // Log the error and output the error message
            Log::error('Error importing data: ' . $e->getMessage());
            $this->error('Error importing data: ' . $e->getMessage());
            return 1;
        }
    }
}
