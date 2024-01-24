@extends('layouts.main')
@section('title', 'Home Page')
@section('content')
<section>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Riwayat BOOKING</h2>
                    </div>
                    <div class="card-body">
                        {{-- <a href="{{ route('excel.transcust') }}" class="btn btn-success mb-2">Download Excel</a> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Total Harga</th>
                                    <th>tanggal</th>
                                    <th>jam</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <ul>
                                                <li> <b>Nama Paket :</b> {{$item->package->name}}</li>
                                                <li><b>Nama Customer:</b> {{$item->customer->name}}</li>
                                                <li><b>Whatsapp: </b> <a href="https://wa.me/{{$item->customer->phone}}">{{$item->customer->phone}}</a></li>

                                                @if($item->person_price)
                                                    <li><b>Add Person: </b> {{$item->person}}</li>
                                                    <li><b>Person Price: </b>{{$item->person_price}}</li>
                                                @endif

                                                @if($item->addprint_price)
                                                <li><b>Print Price: </b> {{$item->addprint_price}}</li>
                                                @endif

                                                @if($item->addbackground_price)
                                                    <li><b>Add Background Price: </b> {{$item->addbackground_price}}</li>
                                                @endif

                                                @if($item->extratime_price)
                                                <li><b>Add Extra time (10 minute): </b> {{$item->extratime_price}}</li>
                                            @endif
                                            </ul>
                                          
                                           
                                        </td>
                                   
                                    <td>
                                        {{$item->total + $item->person_price + $item->addprint_price + $item->addbackground_price + $item->extratime_price}}
                                    </td>
                                    <td>{{$item->tgl_mulai}}
                                    </td>
                                    <td>{{$item->starttime}}
                                    </td>
                                    <td>{{$item->status}}
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
        {{-- <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Riwayat Undangan</h2>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>Title</th>
                                    <th>Tempat Acara</th>
                                    <th>Tgl Mulai</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($undangan as $item)
                                    <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->tempat_acara}}</td>
                                    <td>{{$item->tgl_mulai}}</td>
                                    <td><a href="{{ route('transaksi.edit',$item->id) }}" title="update isi undangan" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></a>
                                        <a href="{{ route('transaksi.wa',$item->id) }}" title="send wa undangan" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="send"></i></a>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- @if (count($undangan))
            <div class="row mt-4">
                <div class="col-lg-6">
                    @foreach ($undangan as $item)
                    <div class="card">
                        <div class="card-header">{{ $item->title }}</div>
                        <div class="card-body">
                            <form action="{{ route('customer.sendsend') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="">nomor whatsapp penerima</label>
                                    <input type="text" class="form-control" name="wanomor">
                                </div>
                                <hr>
                                <button class="btn btn-primary">send</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif --}}
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
