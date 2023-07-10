@extends('layouts.admin')
@section('title', 'transaksis')
@section('content')
<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Transaksi</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('excel.transaksis') }}" class="btn btn-success mb-2">Download Excel</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Customer Name</th>
                                    <th>Order Type</th>
                                    <th>Total</th>
                                    <th>Url Pembayaran</th>
                                    <th>status</th>
                                    <th>created</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->users->name }}</td>
                                    <td>{{ $item->customers->name }}</td>
                                    <td>{{ $item->orders->type_order }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ $item->url_pembayaran }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><a href="{{ route('transaksis.edit',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></a>

                                        <form class="d-inline" action="{{route('transaksis.destroy', $item->id)}}" method="POST" onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>

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
