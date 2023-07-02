@extends('layouts.auth')

@section('contents')

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 shadow-md rounded-md w-full max-w-md">
      <h2 class="text-2xl font-semibold text-center mb-4">Sign Up</h2>
      @if (count($errors) > 0)
                        <div class="alert with-close alert-danger mb-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('POST')
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-medium">Name</label>
          <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500" placeholder="Your name" required>
        </div>
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-medium">Phone</label>
          <input type="number" id="phone" name="phone" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500" placeholder="Your phone" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-medium">Address</label>
          <textarea type="text" id="address" name="address" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500" placeholder="Your Address" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-medium">Email (for login)</label>
          <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500" placeholder="Your email" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 font-medium">Password</label>
          <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500" placeholder="Your password" id="inputPassword" required>
        </div>
        <div class="flex items-center">
          <input type="checkbox" id="terms" name="terms" class="mr-2">
          <label for="terms" class="text-gray-700">I agree to the terms and conditions</label>
        </div>
        <div class="mt-6">
          <button type="submit" class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600">Sign Up</button>
        </div>
      </form>
    </div>
  </div>
  {{-- START AUTO HIDDEN PASS --}}
<script>
  function myFunction() {
      var x = document.getElementById("inputPassword");
      if (x.type === "password") {
          x.type = "text";
      } else {
          x.type = "password";
      }
  }
</script>
{{-- END AUTO HIDDEN PASS --}}
  @endsection
