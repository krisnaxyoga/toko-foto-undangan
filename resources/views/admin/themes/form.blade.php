@extends('layouts.admin')
@section('title','themes')
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
                    <form action="@if($model->exists) {{ route('themes.update', $model->id) }} @else {{ route('themes.store') }} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label class="small mb-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="name" type="text" placeholder="Name" value="{{ old('name', $model->name) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Background <span class="text-danger">*</span></label>
                            <input id="background-image-input" class="form-control form-control-solid" name="background" type="file" placeholder="Background" value="{{ old('background_image_name', $model->background_image_name) }}" />
                            <br>
                            <img style="width: 200px; height: auto;" id="preview_background" src="#" alt="Preview Gambar">
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Price <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="price" type="number" placeholder="price" value="{{ old('price', $model->price) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Mockup Image <span class="text-danger">*</span></label>
                            <input id="mockup-image-input" class="form-control form-control-solid" name="img_mockup" type="file" placeholder="Mockup image" value="{{ old('mockup_image_name', $model->mockup_image_name) }}" />
                            <br>
                            <img style="width: 200px; height: auto;" id="preview_mockup" src="#" alt="Preview Gambar">
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Sambutan <span class="text-danger">*</span></label>
                            {{-- <textarea class="form-control form-control-solid" name="sambutan" id="" cols="30" rows="10" value="{{ old('sambutan', $model->sambutan) }}">{{ old('sambutan', $model->sambutan) }}</textarea> --}}
                            <textarea name="sambutan" id="sambutan" value="{{ old('sambutan', $model->sambutan) }}">{{ old('sambutan', $model->sambutan) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Penutup <span class="text-danger">*</span></label>
                            {{-- <textarea class="form-control form-control-solid" name="penutup" id="" cols="30" rows="10" value="{{ old('penutup', $model->penutup) }}">{{ old('penutup', $model->penutup) }}</textarea> --}}
                            <textarea name="penutup" id="penutup" value="{{ old('penutup', $model->penutup) }}">{{ old('penutup', $model->penutup) }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" type="submit"><i class="far fa-save mr-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('sambutan');
</script>
<script>
    CKEDITOR.replace('penutup');
</script>
<script>
    var backgroundInput = document.getElementById('background-image-input');
    var bgpreviewImg = document.getElementById('preview_background');

    backgroundInput.addEventListener('change', function(e) {
      var file = backgroundInput.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        bgpreviewImg.src = e.target.result;
      }

      reader.readAsDataURL(file);
    });
</script>
<script>
    var mockupInput = document.getElementById('mockup-image-input');
    var mkpreviewImg = document.getElementById('preview_mockup');

    mockupInput.addEventListener('change', function(e) {
      var file = mockupInput.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        mkpreviewImg.src = e.target.result;
      }

      reader.readAsDataURL(file);
    });
  </script>
@endsection
