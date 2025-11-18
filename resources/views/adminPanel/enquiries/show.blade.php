@extends('adminPanel.layout.main')
@section('main-section')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Buyer Inquiries</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-left">
                    {{-- <h5 class="card-title">
                        Total Domains
                    </h5> --}}
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @else
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Buyer</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Spare Parts</th>
                                <th>Condition</th>
                                <th>VIN</th>
                                <th>OEM</th>
                                <th>Send</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->buyer->whatsapp ?? 'N/A' }}</td>
                                    <td>{{ $inquiry->carMake->name ?? 'N/A' }}</td>
                                    <td>{{ $inquiry->carModel->name ?? 'N/A' }}</td>
                                    <td>{{ $inquiry->year->year ?? 'N/A' }}</td>
                                    <td>
                                        {{ $inquiry->partsList->isNotEmpty() ? $inquiry->partsList->pluck('name')->join(', ') : 'N/A' }}
                                    </td>

                                    <td>
                                        @if ($inquiry->condition)
                                            @if ($inquiry->condition == 'new')
                                                <span class="badge badge-success bg-success">
                                                    New
                                                </span>
                                            @elseif ($inquiry->condition == 'used')
                                                <span class="badge badge-warning">
                                                    Used
                                                </span>
                                            @elseif ($inquiry->condition == 'does_not_matter')
                                                <span class="badge badge-secondary">
                                                    Does Not Matter
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $inquiry->vin_num ?? 'N/A' }}</td>
                                    <td>{{ $inquiry->oem_num ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $inquiry->is_send ? 'bg-success' : 'bg-danger' }}">
                                            {{ $inquiry->is_send ? 'Sent' : 'Not Sent' }}
                                        </span>
                                    </td>
                                    <td class="d-flex gap-2 flex-column">
                                        <form action="{{ route('inquiries.send', $inquiry->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Share</button>
                                        </form>
                                        <a href="{{ route('inquiries.send.whatsapp', $inquiry->id) }}"
                                            class="btn btn-success">WhatsApp</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
