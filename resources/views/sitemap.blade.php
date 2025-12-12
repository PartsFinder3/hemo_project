<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Static Pages -->
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
    </url>

    <url>
        <loc>{{ url('/about-us') }}</loc>
    </url>

    <url>
        <loc>{{ url('/blogs') }}</loc>
    </url>

    <url>
        <loc>{{ url('/signup') }}</loc>
    </url>

    <!-- Blogs -->
    @foreach ($blogs as $b)
    <url>
        <loc>{{ route('frontend.blog.view', ['slug' => urlencode($b->slug), 'id' => $b->id]) }}</loc>
        <changefreq>weekly</changefreq>
    </url>
    @endforeach

    <!-- Parts -->
    @foreach ($parts as $part)
    <url>
      <loc>{{ route('part.ads', ['partName' => str_replace(' ', '-', $part->name), 'id' => $part->id]) }}</loc>

        <changefreq>weekly</changefreq>
    </url>
    @endforeach

    <!-- Makes -->
    @foreach ($makes as $make)
    <url>
        <loc>{{ route('make.ads', ['slug' => urlencode($make->name), 'id' => $make->id]) }}</loc>
        <changefreq>weekly</changefreq>
    </url>
    @endforeach

    <!-- Shops -->
    @foreach ($shops as $shop)
    <url>
        <loc>{{ route('view.shop', ['id' => $shop->id]) }}</loc>
        <changefreq>weekly</changefreq>
    </url>
    @endforeach

    <!-- Cities -->
    @foreach ($city as $c)
    <url>
        <loc>{!! route('city.ads', ['slug' => str_replace(' ', '-', $c->slug), 'id' => $c->id]) !!}</loc>
        <changefreq>weekly</changefreq>
    </url>
    @endforeach
</urlset>
