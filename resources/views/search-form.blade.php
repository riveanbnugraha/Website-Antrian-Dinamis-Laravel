<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Captcha UT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .top-bar {
      background-color: #6c63ff;
      color: white;
      padding: 15px;
      font-weight: bold;
      font-size: 18px;
      border-radius: 0 0 8px 8px;
      text-align: center;
    }
    .form-control {
      border-radius: 6px;
      margin-top: 10px;
      height: 40px;
    }
    .btn-primary {
      background-color: #6c63ff;
      border-color: #6c63ff;
    }
    .btn-primary:hover {
      background-color: #554cd6;
      border-color: #4b42c7;
    }
    .footer {
      font-size: 13px;
      text-align: center;
      margin-top: 50px;
      color: #666;
    }
    /* Pesan validasi captcha */
    #captchaError {
      color: #dc3545; /* bootstrap danger color */
      font-size: 0.875em;
      margin-top: 0.25rem;
      display: none;
    }
    /* Container horizontal captcha & input */
    .captcha-container {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 10px;
    }
    canvas#captchaCanvas {
      cursor: pointer;
      border-radius: 6px;
      border: 1px solid #ced4da;
    }
  </style>
</head>
<body>

<div class="top-bar">Universitas Terbuka Surabaya</div>

<div class="container my-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <p>Jadwal Tutorial Tatap Muka atau Tutorial Webinar Universitas Terbuka, 
        <a href="#" class="text-decoration-none text-primary">Masa Registrasi 2025</a>
      </p>

      <!-- Pesan dari Laravel (jika ada) -->
      @if (session('message'))
        <div class="alert alert-warning">{{ session('message') }}</div>
      @endif

      <form method="POST" action="{{ route('search') }}" id="nimForm" novalidate>
        @csrf
        <div class="row align-items-center mb-3">
          <!-- NIM input -->
          <div class="col-md-4">
            <input type="text" class="form-control" id="nim" name="input" placeholder="Masukkan NIM" required />
          </div>

          <!-- Captcha container (canvas dan input captcha side by side) -->
          <div class="col-md-5">
            <div class="captcha-container">
              <canvas id="captchaCanvas" width="120" height="40" title="Klik untuk ganti captcha"></canvas>
              <div style="flex-grow:1;">
                <input type="text" id="captchaInput" class="form-control" placeholder="Isi captcha" required />
                <small class="text-muted">Klik gambar untuk ganti captcha</small>
                <div id="captchaError">Captcha salah atau kosong.</div>
              </div>
            </div>
          </div>

          <!-- Tombol submit -->
          <div class="col-md-3 d-flex justify-content-start">
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>

      <!-- Tabel hasil pencarian (jika ada) -->
      @if (request()->isMethod('post') && count($tuwebs) > 0)
      <div class="table-responsive px-4 pb-4">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Jadwal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tuwebs as $tuweb)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $tuweb->nama }}</td>
              <td>{{ $tuweb->jadwal }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>
</div>

<div class="footer">
  © 2025, made by <strong>Universitas Terbuka</strong>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const canvas = document.getElementById("captchaCanvas");
  const ctx = canvas.getContext("2d");
  const captchaError = document.getElementById("captchaError");
  let captchaCode = "";

  function generateCaptcha() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
    captchaCode = "";
    for (let i = 0; i < 5; i++) {
      captchaCode += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
    gradient.addColorStop(0, "#e0f7fa");
    gradient.addColorStop(1, "#80deea");
    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.font = "bold 22px Arial";
    ctx.fillStyle = "#333";
    ctx.setTransform(1, Math.random() * 0.2, Math.random() * 0.2, 1, Math.random()*10, Math.random()*5);
    ctx.fillText(captchaCode, 15, 30);

    // garis acak
    for (let i = 0; i < 4; i++) {
      ctx.strokeStyle = `rgba(0,0,0,${Math.random()})`;
      ctx.beginPath();
      ctx.moveTo(Math.random()*canvas.width, Math.random()*canvas.height);
      ctx.lineTo(Math.random()*canvas.width, Math.random()*canvas.height);
      ctx.stroke();
    }

    // Reset transform ke default
    ctx.setTransform(1, 0, 0, 1, 0, 0);
  }

  generateCaptcha();
  canvas.addEventListener("click", generateCaptcha);

  document.getElementById("nimForm").addEventListener("submit", function(e) {
    const userCaptcha = document.getElementById("captchaInput").value.trim();
    if (userCaptcha === "" || userCaptcha.toUpperCase() !== captchaCode) {
      e.preventDefault();
      captchaError.style.display = "block";
      generateCaptcha();
      document.getElementById("captchaInput").value = "";
    } else {
      captchaError.style.display = "none";
    }
  });
</script>
</body>
</html>
