@extends('layouts.auth')

@section('contents')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 25rem;">
            <div class="card-header text-center">
              Login
            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <form method="post" action="/login">
                    @csrf
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                      @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                      @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    </div>
                    {{-- <div class="mb-3">
                      <label for="influencer code" class="form-label">Influencer Code</label>
                      <input type="text" name="pin" class="form-control @error('pin') is-invalid @enderror" id="pin" required>
                      @error('pin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    </div> --}}
                    <button type="submit" class="btn btn-primary">LOGIN</button>
                </form>
                <p>lupa password <a href="{{route('forgetpassword.user')}}" class="text-warning">disini</a></p>
                <p>Belum punya akun? <a class="text-success" href="{{ route('register') }}">Daftar disini</a></p>
            </div>
        </div>
    </div>
@endsection
