@extends('layouts.main')
@section('title', 'Home Page')
@section('content')
<section>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Riwayat Transaksi</h2>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>Package name</th>
                                    <th>Description</th>
                                    <th>Transaction</th>
                                    <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                    <td>{{$item->package->name}}</td>
                                    <td>{{$item->package->description}}</td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->status}}</td>
    
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

    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @foreach ($data as $item)
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <ul>
                                    <li>Package name</li>
                                    <li>Description</li>
                                    <li>Transaction</li>
                                    <li>status</li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li>{{$item->package->name}}</li>
                                    <li>{{$item->package->description}}</li>
                                    <li>{{$item->total}}</li>
                                    <li>{{$item->status}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div> --}}
</section>
@endsection