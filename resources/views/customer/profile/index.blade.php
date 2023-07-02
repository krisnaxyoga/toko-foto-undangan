@extends('layouts.main')
@section('title','Profile')
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
                    <form action="{{ route('customer.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label class="small mb-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="name" type="text" placeholder="Name" value="{{ old('name', $model->name) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Password <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="password" type="password" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Confirm Password <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="confirm_password" type="password" placeholder="Confirm Password" />
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
