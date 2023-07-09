<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="/assets_undangan/images/icon/site.webmanifest">

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Beau+Rivage&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <!-- My css -->
    <link rel="stylesheet" href="/assets_undangan/css/pawiwahan.css" />
    <!-- cjQ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- deleted v-1.9.1 -->
    <script src="/assets_undangan/js/jquery.countdown.min.js"></script>
    <style>
      h1,.parag{font-family: 'Tangerine', cursive;}
      h3{font-family: 'Beau Rivage', cursive;}
    </style>
    <title>Undangan Online</title>
  </head>
  <body id="home">
   <header id="home">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home">Undangan Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#galeri">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pesan">Pesan & Doa</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
   </header>
    <!-- akhir navbar -->
    <!-- carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/assets_undangan/images/galeri/galeri1.jpg" class="d-block w-100" alt="galeri1" />
        </div>
        <div class="carousel-item">
          <img src="/assets_undangan/images/galeri/galeri2.jpg" class="d-block w-100" alt="galeri2" />
        </div>
        
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- carousel end -->
    <!-- content -->
    <!-- About start -->
    @foreach ($undangan as $item)
    <main style="background-image: url('/background_img/{{ $item->theme->background }}'); background-repeat: no-repeat; background-size: 100%;">
    <section class="card-a" id="about">
      <div class="container">
        <div class="row text-center mb-3">
          <div class="col">
            <img class="mb-3" src="/assets_undangan/images/ornam/Asset5a.png"/>
            <h2>OM Swastiastu</h2>
          </div>
        </div>
        <div class="row justify-content-center fs-5 text-center">
          <div class="col-md-6">
            <p class="fst-italic">Atas Asung Kertha Wara Nugraha Ida Sang Hyang Widhi Wasa/Tuhan Yang Maha Esa, Kami bermaksud menyelengarakan upacara Pawiwahan putra-putri kami :</p>
          </div>
        </div>
      </div>
    </section>
    <!-- About end -->
    <!-- Jumbotron start -->
    <section class="jumbotron text-center card mpl" id="mpl">
      <div class="container">
        <div class="row justify-content-around">
          <div class="col-md-4 mb-3">
            <img class="mb-3" src="/assets_undangan/images/ornam/Asset5a.png"/>
            <img src="/foto_pria/{{ $item->fotopria }}" width="200" alt="Pawiwahan" class="rounded-circle img-thumbnail" />
            <img class="mt-3 mb-3" src="/assets_undangan/images/ornam/Asset5.png"/>
            <h1 class="text-center">{{ $item->nama_pria }}</h1>
            <h2 class="fs-5">Putra dari pasangan</h2>
            <h2 class="fs-5">{{ $item->ortupria }}</h2>
            <h2 class="fs-5">{{ $item->asalpria }}</h2>
          </div>
        </div>
      </div>
    </section>
    <section class="jumbotron-h text-center">
      <div class="container">
        <div class="row justify-content-around">
          <div class="col-md-4">
            <i class="bi bi-heart-fill text-pink-400"style="font-size: 5rem;"></i>
          </div>
          </div>
        </div>
      </div>
    </section>
    <section class="jumbotron text-center card" id="mpw">
      <div class="container">
        <div class="row justify-content-around">
          <div class="col-md-4">
            <img class="mt-3 mb-3" src="/assets_undangan/images/ornam/Asset5a.png"/>
            <img src="/foto_wanita/{{ $item->fotowanita }}" width="200" alt="Pawiwahan" class="rounded-circle img-thumbnail" />
            <img class="mt-3 mb-3" src="/assets_undangan/images/ornam/Asset5.png"/>
            <h1 class="text-center">{{ $item->nama_wanita }}</h1>
            <h2 class="fs-5">Putri dari pasangan</h2>
            <h2 class="fs-5">{{ $item->ortuwanita }}</h2>
            <h2 class="fs-5">{{ $item->asalwanita }}</h2>
          </div>
        </div>
      </div>
    </section>
    <section class="card" id="calender">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-6 mt-3">
            <p class="fs-5">Merupakan suatu kehormatan dan kebahagiaan bagi kami sekeluarga, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu pada :</p>
            <i class="bi bi-calendar-heart" style="font-size: 4rem;"></i>
            <p class="fs-5">{{ $item->tgl_mulai }}</p>
            <p class="fs-5">Jam {{ $item->waktu_mulai }} - {{ $item->waktu_selesai }} WITA</p>
            <p class="fs-5">Bertempat di {{ $item->tempat_acara }}</p>
            <p class="card-text"></p>
                <a href="{{ $item->maps }}" class="btn btn-outline-success fw-bold"> <i class="bi bi-geo-alt-fill" style="font-size: 1rem"></i> google maps</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Akhir Jumbotron -->
    <!-- Sloka -->
    <section class="card">
      <div class="container col-md-6">
        <div class="row justify-content-center fs-5 text-center">
          <figure class="text-center">
            <blockquote class="blockquote">
              <p class="fst-italic p">"Grbhnāmi te saubhagatvāya hastam, Mayā patyā jaradastir yathāsah, Bhago aryamā savitā puramdhir, Mahyam tvādurgārhapatyāya devāh."</p>
            </blockquote>
            <figcaption class="blockquote-footer">
              <cite title="Source Title">Rgveda : X.85.36</cite>
              <blockquote class="blockquote">
                <p class="fst-italic p">Dalam sebuah pernikahan kalian disatukan demi sebuah kebahagiaan dengan janji hati untuk saling membahagiakan. Bersamaku engkau akan hidup selamanya karena Tuhan pasti akan memberikan karunia sebagai pelindung dan saksi dalam pernikahan ini. Untuk itulah kalian dipersatukan dalam satu keluarga.</p>
              </blockquote>
            </figcaption>
          </figure>
          <div class="col-md">
            <p class="p">Atas Kehadiran serta Do'a Restunya, kami sekeluarga mengucapkan terima kasih. </p>
          </div>
        </div>
        <div class="row text-center mb-3">
          <div class="col mt-3">
            <h2 class="p" >Om Shanti, Shanti, Shanti Om</h2>
          </div>
        </div>
      </div>
    </section>
    <!-- Akhir Sloka -->
    <!-- Full screen modal -->   
    <!-- Galeri -->
    <section class="card" id="galeri">
      <div class="container col-md-6">
        <div class="row text-center mb-3">
          <div class="col">
            <h2>Our Stories</h2>
          </div>
        </div>
        <div class="row" style="display: block;">
          <div class="col-md mb-3">
            <div class="card-">
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/assets_undangan/images/galeri/galeri1.jpg" class="d-block w-100" alt="galeri1.jpg" />
                  </div>
                  <div class="carousel-item">
                    <img src="/assets_undangan/images/galeri/galeri2.jpg" class="d-block w-100" alt="galeri2.jpg" />
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Akhir galeri -->
    <!-- Pesan dan Doa -->
    {{-- <section id="pesan" class="card">
      <div class="container col-md-6">
        <div class="row text-center mb-3 mt-3">
          <div class="col">
            <h2>Pesan & Doa</h2>
          </div>
        </div>
        <div class="col-md">  
            <div class="card-body">
              <h5 class="card-title fst-italic">Doa Restu Anda merupakan karunia yang sangat berarti bagi kami.</h3>
            </div>   
        </div>
      </div>
    </section> --}}
    <!-- Akhir pesan dan doa -->
    </main>
    <!-- content end -->
    <!-- footer -->
    <footer>
      <nav class="footer" style="background-color: rgb(215, 127, 161)">
        <div class="container-fluid">       
        <a href="#" class="text-white fw-bold" style="text-decoration: none">&copy; 2023</a>
        </div>
      </nav>
    </footer>
    <!-- footer end -->
    <!-- Back to top button -->
    <div id="button"></div>
    <!-- modal start -->
    <div id="welcomeModal" class="modal1">
          <div class="hero" style="height: 100vh">
            <div class="container1">
              <h1 class="subtitle">Pawiwahan</h1>
                <h2 class="title"> {{ $item->title }}</h2>
                  <p class="card-text">Yth. Bapak/Ibu/Saudara/i</p>
                  <h3 id="yth"></h3>
                    <h3 id="to"></h3>
                    <h1 id="invite" style="font-size: x-small; padding-left: 20px; padding-right: 20px">Tanpa mengurangi rasa hormat, Kami turut mengundang Anda untuk hadir pada acara pernikahan Kami.</h1>
              <button style="color: #e8ebee; box-sizing: border-box; box-shadow: 4px 4px 11px #caced1,-4px -4px 11px white;
              font-weight: bold; padding: 8px; background-color: #ec7272; border: 0ch; border-radius: 5px;" onclick="closeWelcomeModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-heart" viewBox="0 0 16 16">
                  <path
                    fill-rule="evenodd"
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l3.235 1.94a2.76 2.76 0 0 0-.233 1.027L1 5.384v5.721l3.453-2.124c.146.277.329.556.55.835l-3.97 2.443A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741l-3.968-2.442c.22-.28.403-.56.55-.836L15 11.105V5.383l-3.002 1.801a2.76 2.76 0 0 0-.233-1.026L15 4.217V4a1 1 0 0 0-1-1H2Zm6 2.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"
                  />
                </svg>
                Buka Undangan
              </button>
            </div>
          <div class=""></div>
        </div>
      </div>
    <!-- modal end --> 
    @endforeach
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/assets_undangan/js/pawiwahan.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>
