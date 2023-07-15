@extends('layouts.main')
@section('title', 'Home Page')
@section('content')
<section>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h1>selamat datang {{Auth::user()->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
