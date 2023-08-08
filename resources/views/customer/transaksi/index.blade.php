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
                        {{-- <a href="{{ route('excel.transcust') }}" class="btn btn-success mb-2">Download Excel</a> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>Category</th>
                                    <th>Transaction</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                    <td>{{$item->type_order}}
                                        @if($item->tgl_foto != null)
                                        <p style="font-style:italic">
                                            tgl ambil foto:
                                        {{$item->tgl_foto}}</p>
                                        @endif
                                    </td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>@if($item->status == 'berhasil')
                                        <p class="text-success" style="font-style: italic">lunas</p>
                                        @else
                                        <p class="text-danger" style="font-style: italic">belum lunas</p>
                                       @endif
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
        <div class="row mt-3">
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
        </div>
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
