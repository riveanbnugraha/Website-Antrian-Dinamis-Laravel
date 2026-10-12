<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Universitas Terbuka Surabaya</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card img {
      width: 80px;
      height: auto;
      margin-bottom: 15px;
    }

    .card {
        display: flex;
        position: relative;
    }

    .header-bg {
      background-color: #6a6af4;
      color: white;
      
    }

    .card-border-blue {
      background: linear-gradient(to right, #9fb3df, white, white);
      border: 2px solid #9fb3df;
      border-radius: 20px;
    }

    .card-border-yellow {
      border: 2px solid #ffe5a5;
      border-radius: 20px;
    }

    .card-border-green {
      border: 2px solid #a5f3c2;
      border-radius: 20px;
    }

    .card-border-orange {
      border: 2px solid #ffd2a5;
      border-radius: 20px;
    }

    .card-border-red {
      border: 2px solid #f5a5a5;
      border-radius: 20px;
    }
    
    .btn {
        width: 100px;
        background: linear-gradient(to right, #9fb3df, #9fb3df);
    }

    .btn:hover {
        text-decoration: underline;
        transition: 0.3s;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="container-fluid py-3 text-center header-bg">
    <h1 class="h4">Universitas Terbuka Surabaya</h1>
  </div>

  <!-- Cards Grid -->
  <div class="container py-4">
    <div class="row g-4">

      <!-- Card 1 -->
      <div class="col-md-4 col-sm-6">
        <div class="card card-border-blue h-100 p-3 {{Route::is('tuweb*') ? 'active' : ''}}">
          <img src="https://img.icons8.com/?size=100&id=9KSHaZOU24I7&format=png&color=000000" alt="Mahasiswa">
          <h5 class="card-title">Jadwal Tuweb Mahasiswa</h5>
          <a href="{{route('tuweb.index')}}" class="btn">Masuk</a>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Bootstrap JS (opsional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
