@extends('layouts.landing')
@section('title', 'Home Page')
@section('content')
<section id="what-we-do" class="what-we-do">
        <div class="container">

          <div class="section-title">
            <h2>Order paket</h2>
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <form action="">
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Nama</label>
                          <input type="text" readonly name="name" value="{{$customer[0]->name}}" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Email</label>
                          <input type="text" name="name" readonly value="{{auth()->user()->email}}" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Telepon</label>
                          <input type="text" name="name" readonly value="{{$customer[0]->phone}}" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Alamat</label>
                          <input type="text" name="name" readonly value="{{$customer[0]->address}}" class="form-control form-control-solid">
                        </div>
                      </div>
                      <input type="hidden" value="{{$paket[0]->id}}" name="idpaket">
                      <hr>
                      <div class="mb-2">
                        <div class="from-group">
                          <a href="{{route('customer.bayar',$paket[0]->id)}}" type="submit" class="mr-5 btn btn-primary">Bayar</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                         <p class="mb-2" style="font-weight: bold">Name Package:</p>
                         <p class="mb-2">Price :</p>
                      </div>
                      <div class="col-6">
                       <p class="mb-2">{{$paket[0]->name}}</p> 
                       <p class="mb-2">{{$paket[0]->price}}</p>
                       <p class="mb-2">{{$paket[0]->description}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</section>
@endsection
