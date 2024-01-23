@extends('layouts.landing')
@section('title', 'Home Page')
@section('content')
<style>
  #hero {
    display: none !important;
  }
</style>
<section id="what-we-do" class="what-we-do">
        <div class="container">
          <div class="section-title">
            <h2>Order paket</h2>
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <form action="{{route('customer.bayar',$paket[0]->id)}}" method="get" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Nama</label>
                          <input type="text" readonly name="name" value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Email</label>
                          <input type="text" name="name" readonly value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Telepon</label>
                          <input type="text" name="name" readonly value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Alamat</label>
                          <input type="text" name="name" readonly value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Tanggal Mulai foto</label>
                          <div class="d-flex">
                            <input type="date" name="tgl_mulai" class="form-control form-control-solid">
                            {{-- <input type="time" name="waktu" class="form-control form-control-solid"> --}}
                            <select name="waktu" class="form-control form-control-solid">
                              <!-- Tambahkan opsi untuk jam 10:00 - 18:30 dengan interval 30 menit -->
                              <?php
                                  $start_time = strtotime('10:00');
                                  $end_time = strtotime('18:30');
                          
                                  while ($start_time <= $end_time) {
                                      $formatted_time = date('H:i', $start_time);
                                      echo "<option value=\"$formatted_time\">$formatted_time</option>";
                                      $start_time += 30 * 60; // Tambah 30 menit
                                  }
                              ?>
                          </select>
                          </div>
                         
                        </div>
                      </div>
                      <input type="hidden" value="{{$paket[0]->id}}" name="idpaket">
                      <input type="hidden" value="" name="idstudio">
                      <hr>
                      <div class="mb-2">
                        <div class="from-group">
                          <button type="submit" class="mr-5 btn btn-primary">booking</button>
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
                       <p class="mb-2">Rp. {{ number_format($paket[0]->price , 0, ',', '.')}}</p>
                       <p class="mb-2">{{$paket[0]->description}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="selectForm">
          <label for="selectedId">Pilih ID:</label>
          <select id="selectedId" name="selectedId" class="form-control">
              <option value="1">Studio 1</option>
              <option value="2">Studio 2</option>
              <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
          </select>
          <button type="button" class="btn btn-primary" onclick="selectData()">Pilih</button>
      </form>
      </div>
    </div>
  </div>
</div>


</section>
<!-- Include jQuery (pastikan Anda menyertakan library jQuery jika belum) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Tampilkan modal saat halaman dimuat
    $(document).ready(function(){
        $('#staticBackdrop').modal('show');
    });
</script>
<script>

  function selectData() {
      // Ambil nilai yang dipilih dari dropdown
      var selectedId = $('#selectedId').val();

      // Simpan selectedId di dalam localStorage
      localStorage.setItem('selectedId', selectedId);
      console.log(selectedId,">>>>>sss");
      var selectedId = $('[name="idstudio"]').val(selectedId);
      $('#staticBackdrop').modal('hide');
      // Kirim permintaan ke server untuk mendapatkan data sesuai dengan ID
      // Gunakan AJAX atau metode lainnya sesuai preferensi Anda

      // Contoh menggunakan AJAX dengan jQuery
      // $.ajax({
      //     url: '/get-data/' + selectedId, // Ganti dengan URL yang sesuai di aplikasi Anda
      //     type: 'GET',
      //     success: function(data) {
      //         // Tampilkan data di halaman atau lakukan tindakan lainnya
      //         console.log(data);

      //         // Tutup modal setelah memilih data
      //         $('#myModal').modal('hide');
      //     },
      //     error: function(error) {
      //         console.error(error);
      //     }
      // });
  }
</script>
@endsection
