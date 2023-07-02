@extends('layouts.landing')
@section('title', 'Home Page')
@section('content')
<section id="what-we-do" class="what-we-do">
        <div class="container">

          <div class="section-title">
            <h2>Order Undangan</h2>
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <form action="{{route('customer.bayarundangan')}}" method="get" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <div class="form-group">
                              <label for="" class="ml-0 mb-2">Nama panggilan Pria & Wanita</label>
                              <input type="text" name="title" value="" class="form-control form-control-solid" placeholder="masukan panggilan misalnya made & ni luh">
                            </div>
                          </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">Nama Mempelai Pria</label>
                          <input type="text" name="pria" value="" class="form-control form-control-solid" placeholder="masukan nama mempelai pria">
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">Nama Mempelai Wanita</label>
                          <input type="text" name="wanita" value="" class="form-control form-control-solid" placeholder="masukan nama mempelai wanita">
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">Tempat acara</label>
                          <input type="text" name="tempat" value="" class="form-control form-control-solid" placeholder="masukan tempat acara">
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">Lokasi acara (link googlemaps)</label>
                          <input type="text" name="maps" value="" class="form-control form-control-solid" placeholder="masukan link google maps">
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">Tanggal mulai</label>
                          <input type="date" name="tglmulai" value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">Tanggal selesai</label>
                          <input type="date" name="tglselesai" value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">waktu mulai</label>
                          <input type="text" name="waktumulai" value="" class="form-control form-control-solid" placeholder="misalnya 09:00 pagi">
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="" class="ml-0 mb-2">waktu selesai</label>
                          <input type="text" name="waktuselesai" value="" class="form-control form-control-solid" placeholder="misalnya 04:00 sore atau sampai selesai">
                        </div>
                      </div>
                      <input type="hidden" name="theme" value="{{$theme[0]->id}}" name="idpaket">
                      <hr>
                      <div class="mb-3">
                        <div class="from-group">
                          <button type="submit" class="mr-5 btn btn-primary">Bayar</button>
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
                         <p class="mb-3" style="font-weight: bold">Name Package:</p>
                         <p class="mb-3">Price :</p>
                      </div>
                      <div class="col-6">
                       <p class="mb-3">{{$theme[0]->name}}</p>
                       <p class="mb-3">{{$theme[0]->price}}</p>
                       <p class="mb-3"><img src="{{$theme[0]->img_mockup}}" alt=""> </p>
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
