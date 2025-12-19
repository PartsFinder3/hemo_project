<?php

namespace App\Jobs;
use OpenAI;
use App\Models\SeoContentMake;
use App\Models\CarMakes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateSeoContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $make;

    /**
     * Create a new job instance.
     */
    public function __construct(CarMakes $make)
    {
        $this->make = $make;
    }

    /**
     * Execute the job.
     */
   public function handle(): void
{
    $client = OpenAI::client(config('services.openai.key'));
    $brand = $this->make->name;

    $response = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'user',
                'content' => "Write SEO-optimized content for auto parts brand: {$brand}"
            ]
        ],
    ]);

    $seoContent = $response->choices[0]->message->content ?? null;

    // Debug log
    Log::info("SEO Job for Make: {$brand}");
    Log::info("SEO Content: " . $seoContent);

    if($seoContent) {
        SeoContentMake::create([
            'make_id' => $this->make->id,
            'seo_content_make' => $seoContent,
        ]);
    } else {
        Log::warning("SEO content was empty for Make: {$brand}");
    }

    sleep(7);
}

}
