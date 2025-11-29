@extends('adminPanel.layout.main')
@section('main-section')

<div class="container mt-4">
    <h2>Assign SEO Template to Product</h2>

    <form action="#" method="POST">
        @csrf

        <!-- Select SEO Template -->
        <div class="mb-3">
            <label for="seo_template" class="form-label">Select SEO Template</label>

            <select id="seo_template" name="seo_template_id" class="form-select" required>
                <option value="">-- Choose Template --</option>

                @foreach($allTemplte as $temp)
                    <option 
                        value="{{ $temp->id }}" 
                        data-description="{{ $temp->description }}"
                        data-structure="{{ $temp->Data_Structure }}"
                        {{ $getTamp && $getTamp->id == $temp->id ? 'selected' : '' }}
                    >
                        {{ $temp->title }}
                    </option>
                @endforeach

            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign Template</button>
    </form>

    <!-- Preview Row -->
    <div class="mt-4">
        <h5>Selected Template Preview:</h5>
        <div class="card p-3" id="template_preview">
          <strong>Template Name:</strong> 
            <span id="preview_name">{{ $getTamp->title ?? 'No Template Selected' }}</span>
            <br>

            <strong>Description:</strong> 
            <span id="preview_description">{{ $getTamp->description ?? 'No Description' }}</span>
            <br>

            <strong>Data Structure:</strong>
<pre id="preview_structure" style="white-space: pre-wrap; font-size:14px;">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $parts->name }}",
  "image": "{{ asset($parts->image) }}",
  "description": "{{ $getTamp->description ?? 'No Description' }}",
  "brand": {
    "@type": "Brand",
    "name": "Parts Finder"
  },
  @php
$dummySku = 'SKU-' . strtoupper(Str::random(8));
@endphp
"sku": "{{ $dummySku }}"
  "category": " Spare Parts",
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "AED",
 
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  }
}
</pre>

        </div>
    </div>
</div>

@endsection
