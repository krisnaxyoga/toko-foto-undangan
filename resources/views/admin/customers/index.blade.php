@extends('layouts.admin')
@section('title', 'customers')
@section('content')
<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Customers</h2>
                </div>
                <div class="card-body">
                    {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary mb-2">add</a> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
