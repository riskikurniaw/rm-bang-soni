<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM BANG SONI - PESAN MAKANAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff5f5; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: linear-gradient(45deg, #b71c1c, #d32f2f); }
        .btn-danger { background: #d32f2f; border: none; transition: 0.3s ease-in-out; }
        .btn-danger:hover { background: #b71c1c; transform: scale(1.05); }
        footer { background: #d32f2f; color: white; padding: 10px; margin-top: 30px; text-align: center; }
        .card-menu { border: none; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-menu:hover { transform: translateY(-8px); box-shadow: 0 8px 18px rgba(0,0,0,0.2); }
        .section-title { text-align: center; margin-bottom: 20px; font-weight: bold; color: #b71c1c; }
        .form-section { background: white; border-radius: 15px; box-shadow: 0 8px 18px rgba(0,0,0,0.1); padding: 25px; max-width: 600px; margin: auto; margin-bottom: 30px; }
        .btn-green { background: #28a745; border: none; color: white; transition: 0.3s ease-in-out; }
        .btn-green:hover { background: #218838; transform: scale(1.05); }
        .qty-input { width: 80px; text-align: center; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold fs-4" href="#">🍛 RM BANG SONI</a>
            <a href="{{ route('login') }}" class="btn btn-light text-danger fw-bold shadow-sm">🔑 Login</a>
        </div>
    </nav>

    <div class="container my-4">
        <!-- Judul -->
        <h2 class="text-center mb-4 text-danger fw-bold">
            SELAMAT DATANG DI RM BANG SONI <br>
            <small class="text-dark fs-5 fw-normal">Nikmati Hidangan Lezat & Pesan dengan Mudah</small>
        </h2>

        <!-- Alert Sukses -->
        @if(session('success'))
            <div class="alert alert-success text-center shadow-sm fw-bold w-50 mx-auto">✅ {{ session('success') }}</div>
        @endif

        <form action="{{ route('order') }}" method="POST">
            @csrf

            <!-- Form Data Pemesan -->
            <div class="form-section">
                <h4 class="text-center text-danger mb-3 fw-bold">🧾 DATA PEMESAN</h4>
                <div class="mb-3">
                    <label class="form-label">Nama Pemesan</label>
                    <input type="text" name="nama_pelanggan" class="form-control form-control-lg" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control form-control-lg" placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Ambil</label>
                    <input type="date" name="tanggal_ambil" class="form-control form-control-lg" required>
                </div>
            </div>

            <!-- Daftar Menu -->
            <h4 class="section-title">🍽 PILIH MENU FAVORIT ANDA</h4>
            <div class="row">
                @foreach($menu as $m)
                <div class="col-md-4 mb-4">
                    <div class="card card-menu shadow-sm h-100">
                        @if($m->foto)
                            <img src="{{ asset('storage/'.$m->foto) }}" class="card-img-top" alt="{{ $m->nama_menu }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $m->nama_menu }}</h5>
                            <p class="card-text text-danger fw-bold fs-5">{{ 'Rp ' . number_format($m->harga, 0, ',', '.') }}</p>
                            <div class="d-flex align-items-center mb-2">
                                <input type="checkbox" name="menu[{{ $m->id }}]" value="{{ $m->id }}" class="form-check-input me-2" id="menu{{ $m->id }}">
                                <label class="form-check-label" for="menu{{ $m->id }}">Pilih Menu</label>
                            </div>
                            <label class="mt-2">Jumlah:</label>
                            <input type="number" name="jumlah[{{ $m->id }}]" class="form-control qty-input" value="1" min="1" disabled>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tombol Pesan -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-green btn-lg px-5 shadow-sm">📥 KIRIM PESANAN SEKARANG</button>
            </div>
        </form>
    </div>

    <footer>
        <p>© 2025 <strong>RM BANG SONI</strong> | Dibuat dengan ❤️ untuk pelayanan terbaik</p>
    </footer>

    <script>
        // Aktifkan jumlah hanya jika checkbox dipilih
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const qtyInput = this.closest('.card-body').querySelector('input[type="number"]');
                qtyInput.disabled = !this.checked;
                if(!this.checked) qtyInput.value = 1;
            });
        });
    </script>
</body>
</html>
