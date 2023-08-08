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

                    {{-- Untuk filter datatable --}}
                    <form action="{{ route('transaksis.filter') }}">
                        <div class="d-flex">
                            <div class="form-group">
                                <input type="date" class="form-control" id="startdate" value="{{ old('startdate', request('startdate')) }}" name="startdate">
                            </div>
                            <p class="mx-2">To</p>
                            <div class="form-group">
                                <input type="date" class="form-control" id="enddate" value="{{ old('enddate', request('enddate')) }}" name="enddate">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-secondary mx-2">Filter</button>
                            </div>

                        </div>
                    </form>

                    {{-- Untuk Filter Excel --}}
                    <form action="{{ route('excel.transaksis') }}">
                        <div class="d-flex">
                            <div class="form-group">
                                <input type="hidden" value="{{ now()->format('Y-m-d') }}" class="form-control" id="exstartdate" name="exstartdate">
                            </div>
                            <div class="form-group">
                                <input type="hidden" value="{{ now()->addMonth()->format('Y-m-d') }}" class="form-control" id="exenddate" name="exenddate">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success mx-2"><i class="fa fa-file-excel" aria-hidden="true"></i> &nbsp; Download Excel</button>
                                <button class="btn btn-primary mx-2" onclick="printButton()"><i class="fa fa-file-pdf" aria-hidden="true"></i> &nbsp; Cetak laporan</button>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Address</th>
                                    <th>Order Type</th>
                                    <th>Total</th>
                                    <th>Url Pembayaran</th>
                                    <th>Status</th>
                                    <th>Tgl Mulai Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $a => $item)
                                    <tr>
                                        <td>{{ $a + 1 }}</td>
                                        <td>{{ $item->customers->name }}</td>
                                        <td>{{ $item->customers->phone }}</td>
                                        <td>{{ $item->customers->address }}</td>
                                        <td>{{ $item->orders->type_order }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->url_pembayaran }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->tgl_foto }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="8">Print By : {{ auth()->user()->name }}</th> <!-- Kolom baru -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script>
    function printButton() {
                var printContents = $('#dataTable').prop('outerHTML');
                var originalContents = $('body').html();
                $('body').html(printContents);
                window.print();
    }
</script>
<script>
    var startDate = document.getElementById('startdate');
    var endDate = document.getElementById('enddate');
    var exstartDate = document.getElementById('exstartdate');
    var exendDate = document.getElementById('exenddate');
    startDate.addEventListener('change', function() {
      exstartDate.value = startDate.value;
    });
    endDate.addEventListener('change', function() {
      exendDate.value = endDate.value;
    });
    exstartDate.value = startDate.value;
    exendDate.value = endDate.value;
    </script>
@endsection
