<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateLeadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadData;

    /**
     * Create a new job instance.
     */
    public function __construct($leadData)
    {
        $this->leadData = $leadData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();

        try {
            $response = $client->post('https://example.bitrix24.ru/rest/1/your_webhook_here/crm.lead.add', [
                'json' => [
                    'fields' => [
                        'TITLE' => 'New Lead',
                        'NAME' => $this->leadData['name'],
                        'PHONE' => [
                            ['VALUE' => $this->leadData['phone'], 'VALUE_TYPE' => 'WORK']
                        ],
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            $this->release(10);
        }
    }
}
