@extends('layout.dashboard')

@section('title', 'Main Dashboard')

@section('content')
    <section class="mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Invoice</strong></h5>
                </div>

                <div class="card-body p-0">
                    <table class="table align-middle mb-0 bg-white table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Create at</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr data-id="{{ $invoice->id }}">
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->name }}</td>
                                    <td>{{ number_format($invoice->total, 0, ',', '.') }}</td>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ $invoice->address }}</td>
                                    <td>{{ $invoice->phone }}</td>
                                    <td>{{ $invoice->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
