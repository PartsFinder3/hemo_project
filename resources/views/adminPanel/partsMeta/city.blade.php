@extends('adminPanel.layout.main')
@section('main-section')

<div class="container mt-4">
<a href="{{ route('city.show') }}" class="btn btn-secondary mb-3">← Back</a>

    <h2>Assign SEO Template to Product</h2>

  <form action="{{ route('city.seo.post', $parts->id) }}" method="POST">
    @csrf

    <!-- Select Title Template -->
    <div class="mb-3">
        <label for="title_template" class="form-label">Select Title Template</label>
        <select id="title_template" name="title_template_id" class="form-select" required>
            <option value="">-- Choose Title Template --</option>

            @foreach($allTitle as $t)
                <option value="{{ $t->id }}" {{ $getTitle && $getTitle->id == $t->id ? 'selected' : '' }}>
                    {{ $t->tittle }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Select Description Template -->
    <div class="mb-3">
        <label for="seo_template" class="form-label">Select Description Template</label>
        <select id="seo_template" name="seo_template_id" class="form-select" required>
            <option value="">-- Choose Description Template --</option>

            @foreach($allTemplte as $temp)
                <option value="{{ $temp->id }}" {{ $getTamp && $getTamp->id == $temp->id ? 'selected' : '' }}>
                    {{ $temp->description }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Assign Templates</button>
</form>
    
    <!-- Preview Row -->
    <div class="mt-4">
        <h5>Selected Template Preview:</h5>
        <div class="card p-3" id="template_preview">
          <strong>Template tittle:</strong> 
            <span id="preview_name">{{ $getTitle->tittle ?? 'No Template Selected' }}</span>
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
  "image": "{{ asset('storage/'. $parts->image) }}",
  "description": "{{ $getTamp->description ?? 'No Description' }}",
  "brand": {
    "@type": "Brand",
    "name": "Parts Finder"
  },
  @php
$dummySku = 'SKU-' . strtoupper(Str::random(8));
@endphp
"sku": "{{ $dummySku }}",
  "category": "Spare Parts",
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
    <form action="{{ route('model.seo.post', $parts->id) }}" method="POST">
