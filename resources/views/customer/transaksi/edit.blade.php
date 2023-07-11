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
                    <form action="@if($model->exists) {{ route('transaksi.update', $model->id) }} @else {{ route('transaksi.update') }} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label class="small mb-1">Judul Undangan <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="title" type="text" placeholder="Judul Undangan" value="{{ old('title', $model->title) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Nama Pria <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="nama_pria" type="text" placeholder="Nama mempelai pria" value="{{ old('nama_pria', $model->nama_pria) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Nama Wanita <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="nama_wanita" type="text" placeholder="Nama mempelai wanita" value="{{ old('nama_wanita', $model->nama_wanita) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="tgl_mulai" type="date" placeholder="Pilih tanggal mulai acara" value="{{ old('tgl_mulai', $model->tgl_mulai) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="tgl_selesai" type="date" placeholder="Pilih tanggal selesai acara" value="{{ old('tgl_selesai', $model->tgl_selesai) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Waktu Mulai <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="waktu_mulai" type="text" placeholder="Pilih waktu mulai acara" value="{{ old('waktu_mulai', $model->waktu_mulai) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Waktu Selesai <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="waktu_selesai" type="text" placeholder="Pilih waktu selesai acara" value="{{ old('waktu_selesai', $model->waktu_selesai) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Tempat Acara <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-solid" name="tempat_acara" id="" cols="30" rows="10" value="{{ old('tempat_acara', $model->tempat_acara) }}">{{ old('tempat_acara', $model->tempat_acara) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Url Maps <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="maps" type="text" placeholder="Pilih URL maps acara" value="{{ old('maps', $model->maps) }}" />
                        </div>
                        <div class="form-group">
                            <?php if(old('fotopria', $model->fotopria) !== null){ ?>
                            <label class="small mb-1">Foto Pria (old)<span class="text-danger">*</span></label>
                                <img src="/foto_pria/{{ $model->fotopria }}" class="img-fluid" style="width:200px;height:150px" alt=""/>
                                <?php } ?>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Foto Pria <span class="text-danger">*</span></label>
                            <input id="pria-image-input" class="form-control form-control-solid" name="fotopria" type="file" placeholder="Foto Pria" value="{{ old('fotopria', $model->fotopria) }}" />
                            <br>
                            <img style="width: 200px; height: auto;" id="previewpria" src="#" alt="Preview Gambar">
                        </div>
                        <div class="form-group">
                            <?php if(old('fotowanita', $model->fotowanita) !== null){ ?>
                            <label class="small mb-1">Foto Wanita (old)<span class="text-danger">*</span></label>
                                <img src="/foto_wanita/{{ $model->fotowanita }}" class="img-fluid" style="width:200px;height:150px" alt=""/>
                                <?php } ?>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Foto Wanita <span class="text-danger">*</span></label>
                            <input id="wanita-image-input" class="form-control form-control-solid" name="fotowanita" type="file" placeholder="Foto Wanita" value="{{ old('fotowanita', $model->fotowanita) }}" />
                            <br>
                            <img style="width: 200px; height: auto;" id="previewwanita" src="#" alt="Preview Gambar">
                        </div>
                        {{-- <div class="form-group">
                            <label class="small mb-1">Foto Galeri (Bisa Pilih foto lebih dari satu)<span class="text-danger">*</span></label>
                            <input type="file" class="form-control form-control-solid" name="gallery[]" multiple>
                            {{-- <input id="fileInput" class="form-control form-control-solid" name="fotopria" type="file" placeholder="Foto Pria" value="{{ old('fotopria', $model->fotopria) }}" /> --}}
                        {{-- </div> --}}
                        <div class="form-group">
                            <label class="small mb-1">Nama Orang Tua mempelai Pria <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="ortupria" type="text" placeholder="Contoh : I Made Subak & Ni Wayan Sekar" value="{{ old('ortupria', $model->ortupria) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Nama Orang Tua mempelai Wanita <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="ortuwanita" type="text" placeholder="Contoh : I Nyoman Sangkep & Ni Ketut Sugih" value="{{ old('ortuwanita', $model->ortuwanita) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Asal mempelai Pria <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="asalpria" type="text" placeholder="Contoh : Br.Sebunibus Sakti Nusa Penida" value="{{ old('asalpria', $model->asalpria) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Asal mempelai Wanita <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="asalwanita" type="text" placeholder="Contoh : Br. Kesiman Kertalangu" value="{{ old('asalwanita', $model->asalwanita) }}" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary float-left" type="cancel"> Batal</button>
                            <button class="btn btn-primary float-right" type="submit"><i class="far fa-save mr-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var priaInput = document.getElementById('pria-image-input');
    var priapreviewImg = document.getElementById('previewpria');

    priaInput.addEventListener('change', function(e) {
      var file = priaInput.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        priapreviewImg.src = e.target.result;
      }

      reader.readAsDataURL(file);
    });
</script>
<script>
    var wanitaInput = document.getElementById('wanita-image-input');
    var wanitapreviewImg = document.getElementById('previewwanita');

    wanitaInput.addEventListener('change', function(e) {
      var file = wanitaInput.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        wanitapreviewImg.src = e.target.result;
      }

      reader.readAsDataURL(file);
    });
  </script>
@endsection
