@extends('layouts.main')
@section('title','transaksi')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">@if($model->exists) Edit @else Tambah @endif  @yield('title')</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert with-close alert-danger mb-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('customer.sendsend',$id) }}" method="post" enctype="multipart/form-data">
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
        </div>
    </div>
</div>

@endsection
