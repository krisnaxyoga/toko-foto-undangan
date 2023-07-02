<!DOCTYPE html>
<html>
<head>
  <title>Undangan Pernikahan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f5f5f5;
      padding-top: 50px;
    }
    .container {
      max-width: 600px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin: 0 auto;
    }
    h1 {
      color: #333;
      text-align: center;
    }
    p {
      color: #555;
      line-height: 1.5;
      margin-bottom: 20px;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #337ab7;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
    }
    .button:hover {
      background-color: #23527c;
    }
  </style>
</head>
<body>
    @foreach ($undangan as $item)
  <div class="container" style="background-image: url('/background_img/{{ $item->theme->background }}'); background-repeat: no-repeat; background-size: 100% 100%;">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color: #ffffff4a;">
                <div class="card-body">
                    <h1>{{ $item->title }}</h1>
                    <p>Dear Teman-Teman,</p>
                    <p>Kami dengan senang hati mengundang Anda untuk menghadiri pernikahan kami:</p>
                    <h2>Tanggal & Waktu:</h2>
                    <p>{{ $item->tgl_mulai }} - {{ $item->tgl_selesai }} <br>
                         {{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</p>
                    <h2>Lokasi:</h2>
                    <p>{{ $item->tempat_acara }}</p>
                    <p>{{ strip_tags($item->theme->penutup) }}</p>
                    <p>Terima kasih atas perhatian dan kehadirannya.</p>
                    <p>Salam hangat,</p>
                    <p>{{ $item->title }}</p>
                </div>
            </div>
        </div>
    </div>
  </div>
  @endforeach
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
