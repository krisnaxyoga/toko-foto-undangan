@extends('layouts.main')
@section('title', 'Home Page')
@section('content')
<section>
    <div class="container">
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
    </div>
</section>
@endsection
