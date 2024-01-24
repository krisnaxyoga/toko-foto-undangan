@php
  use Carbon\Carbon;
@endphp
@extends('layouts.landing')
@section('title', 'Home Page')
@section('content')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
  #hero {
    display: none !important;
  }
</style>
<section id="what-we-do" class="what-we-do">
        <div class="container mt-5">
          <div class="section-title">
            <h2>Order paket</h2>
            <div class="row">
              <div class="col-lg-6 mb-3">
                <div class="card ">
                  <div class="card-body">
                    <form action="{{route('customer.bayar',$paket[0]->id)}}" method="get" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Nama</label>
                          <input type="text" name="name" value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Email</label>
                          <input type="text" name="email" value="" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Telepon (Whatsapp)</label>
                          <input type="text" name="telepon" value="08" class="form-control form-control-solid">
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Tanggal Mulai foto</label>
                          <div class="d-flex">
                            <?php
                              $carbonDate = Carbon::parse($date);
                              ?>
                            {{-- <input type="text" id="dates" name="dates" class="form-control form-control-solid datepicker"> --}}
                            <input class="form-control" type="date" name="dates" value="{{$date}}" onchange="available()"/>
                            {{-- <input type="text" id="waktu" class="form-control form-control-solid timepicker"> --}}
                            {{-- <input type="date" name="tgl_mulai" class="form-control form-control-solid"> --}}
                            <select name="waktu" class="form-control form-control-solid">
                              <!-- Tambahkan opsi untuk jam 10:00 - 18:30 dengan interval 30 menit -->
                            <option value="">-select time-</option>
                              <?php
                              $start_time = strtotime('10:00');
                              $end_time = strtotime('18:30');
                          
                              while ($start_time <= $end_time) {
                                  $formatted_time = date('H:i', $start_time);
                          
                                  // Cek apakah waktu ini sudah ada pada Order untuk tanggal yang dipilih
                                  $isTimeInOrder = false;
                                 
                                  foreach ($order as $orderx) {
                                      if ( $orderx->starttime == $formatted_time) {
                                          $isTimeInOrder = true;
                                          break;
                                      }
                                  }
                          
                                  // Tetapkan warna merah jika waktu ada pada Order
                                  $textColor = $isTimeInOrder ? 'color:red;' : '';

                                  $disabled = $isTimeInOrder ? 'disabled' : '';

                                  $available = $isTimeInOrder ? '(Unavailable)' : $formatted_time;
                          
                                  echo "<option value=\"$formatted_time\" ".$disabled." style=\"$textColor\">$available</option>";
                          
                                  $start_time += 30 * 60; // Tambah 30 menit
                              }
                              ?>
                          </select>
                          </div>

                        </div>
                      </div>

                      <div class="mb-2 mt-4">
                        <div class="form-group">
                          
                          <div class="d-flex justify-content-center">
                           <p style="font-weight:700" class="m-0">ADITIONAL</p>
                          </div>
                          
                        </div>
                      </div>

                      <div class="mb-2">
                        <div class="form-group">
                          <label for="">Person</label>
                          <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-success mx-2" id="addPersonBtn">+</a>
                            <input readonly class="form-control" style="width:100px" type="number" id="personCount" value="0" name="person">
                            <a href="#" class="btn btn-warning mx-2" id="endPersonBtn">-</a>
                          </div>
                          
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          
                          <div class="d-flex">
                           
                           <input type="checkbox" class="form-check-input" id="extraTimeCheckbox" name="extratime" value="25000" >
                           <label for="">extra time (10 minutes)
                           </label>
                          </div>
                          
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          
                          <div class="d-flex">
                           
                           <input type="checkbox" class="form-check-input" id="backgroundCheckbox" name="background" value="20000" >
                           <label for="">add background
                           </label>
                          </div>
                          
                        </div>
                      </div>
                      <div class="mb-2">
                        <div class="form-group">
                          
                          <div class="d-flex">
                           
                           <input type="checkbox" class="form-check-input" id="printCheckbox" name="print" value="15000" >
                           <label for="">add print
                           </label>
                          </div>
                          
                        </div>
                      </div>

                      <input type="hidden" value="{{$paket[0]->id}}" name="idpaket">
                      @if($idstudio == null)
                        <input type="hidden" value="" name="idstudio">
                        @else
                        <input type="hidden" value="{{$idstudio}}" name="idstudio">
                      @endif
                      
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
                      
                       <input type="hidden" value="{{$paket[0]->price}}" name="totprice">
                        <p class="mb-2 paketprice">Rp. <span id="totalPrice">{{ number_format($paket[0]->price, 0, ',', '.') }}</span></p>
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
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
      </div>
      <div class="modal-body">
        <form id="selectForm">
          <label for="selectedId">Pilih ID:</label>
          <select id="selectedId" name="selectedId" class="form-control">
            @foreach ($cabang as $cab)
            <option value="{{$cab->id}}">{{$cab->name}}</option>
            @endforeach
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



<script>
    $(document).ready(function () {
        // Harga awal paket
        var paketPrice = $('[name="totprice"]').val();

        // Harga per orang
        var pricePerPerson = 20000;

          // Harga tambahan untuk extra time
          var extraTimePrice = 25000;

          var addbackground = 20000;

          var addprint = 15000;

          // Jumlah awal orang
          var personCount = 0;

          // Status extra time (dicentang atau tidak)
          var isExtraTimeChecked = false;

          var isBackgroundChecked = false;

          var isPrintChecked = false;

        // Tampilkan harga awal
        updateTotalPrice();

        $("#endPersonBtn").on("click", function () {
            // Tambahkan satu orang
            personCount = parseInt(personCount) - 1;

            // Hitung total harga berdasarkan jumlah orang
            paketPrice = parseInt(paketPrice) - parseInt(pricePerPerson);

            $("#personCount").val(personCount);
            // Perbarui tampilan harga dan jumlah orang
            if(personCount != 0){
              updateTotalPrice();
            }
            
        });

        // Handler untuk tombol "Add Person"
        $("#addPersonBtn").on("click", function () {
            // Tambahkan satu orang
            personCount++;

            // Hitung total harga berdasarkan jumlah orang
            paketPrice = parseInt(paketPrice) + parseInt(pricePerPerson);

            // Perbarui tampilan harga dan jumlah orang
            updateTotalPrice();
        });

         // Handler untuk checkbox "extra time"
         $("#extraTimeCheckbox").on("change", function () {
            // Perbarui status extra time
            isExtraTimeChecked = $(this).prop("checked");
            if(isExtraTimeChecked){
              paketPrice = parseInt(paketPrice) + parseInt(extraTimePrice);
            }else{
              paketPrice = parseInt(paketPrice) - parseInt(extraTimePrice);
            }
            

            // Perbarui tampilan harga
            updateTotalPrice();
        });

        $('#backgroundCheckbox').on("change", function () {
            // Perbarui status extra time
            isBackgroundChecked = $(this).prop("checked");
            if(isBackgroundChecked){
              paketPrice = parseInt(paketPrice) + parseInt(addbackground);
            }else{
              paketPrice = parseInt(paketPrice) - parseInt(addbackground);
            }
            

            // Perbarui tampilan harga
            updateTotalPrice();
        });

        $('#printCheckbox').on("change", function () {
            // Perbarui status extra time
            isPrintChecked = $(this).prop("checked");
            if(isPrintChecked){
              paketPrice = parseInt(paketPrice) + parseInt(addprint);
            }else{
              paketPrice = parseInt(paketPrice) - parseInt(addprint);
            }
            

            // Perbarui tampilan harga
            updateTotalPrice();
        });

        // Fungsi untuk memperbarui tampilan harga dan jumlah orang
        function updateTotalPrice() {
            $('[name="totprice"]').val(paketPrice);
            $("#totalPrice").text(numberFormat(paketPrice));
            $("#personCount").val(personCount);
        }

        // Fungsi untuk memformat angka ke format mata uang
        function numberFormat(number) {
            return "" + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });
  // Inisialisasi Daterangepicker untuk input tanggal
  // $('[name="dates"]').daterangepicker({
  //           autoApply: true,
  //           singleDatePicker: true,
  //           showDropdowns: true,
  //           locale: {
  //               format: 'YYYY-MM-DD',
  //           }
  //       });

</script>
@if($idstudio == null)
  <script>
    // Tampilkan modal saat halaman dimuat
    $(document).ready(function(){
        $('#staticBackdrop').modal('show');
    });
</script>
@endif


<script>

function available(){
  var idstudio = $('[name="idstudio"]').val();
  var formattedCheckin = $('[name="dates"]').val();
  var formattedCheckin = $('[name="dates"]').val();
  var contractId = '{{ $paket[0]->id }}'; // Ganti dengan cara Anda mendapatkan contract_id
  var url = '/customer/available/' + contractId +
                '?date=' + formattedCheckin +
                '&idstudio='+ idstudio;

            // Lakukan pengalihan ke halaman yang diinginkan
            window.location.href = url;
}
  function selectData() {
      // Ambil nilai yang dipilih dari dropdown
      var selectedId = $('#selectedId').val();

      // Simpan selectedId di dalam localStorage
      localStorage.setItem('selectedId', selectedId);
      console.log(selectedId,">>>>>sss");
     
      var selectedId = $('[name="idstudio"]').val(selectedId);
      $('#staticBackdrop').modal('hide');
      available();
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
