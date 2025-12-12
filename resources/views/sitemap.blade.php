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
        <loc>{{ route('frontend.blog.view', ['slug' => $b->slug, 'id' => $b->id]) }}</loc>
        <changefreq>weekly</changefreq>
    </url>
    @endforeach

    <!-- Parts -->
    @foreach ($parts as $part)
    <url>
        <loc>{{ route('part.ads', ['partName' => $part->name, 'id' => $part->id]) }}</loc>
        <changefreq>weekly</changefreq>
    </url>
    @endforeach

    <!-- Makes -->
    @foreach ($makes as $make)
    <url>
        <loc>{{ route('make.ads', ['slug' => $make->name, 'id' => $make->id]) }}</loc>
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

</urlset>
