<?php

namespace App\Jobs;
use OpenAI;

use App\Models\CarMakes;
use App\Models\SeoContentMake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class GenerateSeoContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $make;

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
                    'content' => "
Write SEO-optimized content for an auto parts website.
Use:
- <h1> for main headings
- <h2> for subheadings
- <p> for paragraphs
- <ul><li> for lists
Brand: {$brand}

Purpose:
This content will be placed at the bottom of a category or brand page to improve SEO and topical relevance.

Target Audience:
Users searching to buy or research auto parts related to this brand.

Content Structure:
1. About the {$brand}
- Brief, factual overview
- Focus on reliability, compatibility, and brand relevance in the auto parts industry

2. Common Parts Available
- Mention commonly searched and purchased parts
- Keep it generic and adaptable (no model-specific claims unless obvious)
- Use bullet points where appropriate

3. Why Buy From Us
- Emphasize product quality, fitment accuracy, availability, and customer trust
- No exaggerated marketing or promotional language

SEO Requirements:
- 350–400 words total
- Clear, professional, and informative tone
- Naturally optimized for search engines
- Avoid keyword stuffing
- No competitor mentions
- No storytelling or fluff
- No calls to action like “Buy Now” or “Order Today”

Formatting:
- Plain text
- Short paragraphs
- No emojis
- No markdown
                    "
                ],
            ],
        ]);

        $seoContent = $response->choices[0]->message->content;

        // Save to database
        SeoContentMake::create([
            'make_id' => $this->make->id,
            'seo_content_make' => $seoContent,
        ]);
    }
}
