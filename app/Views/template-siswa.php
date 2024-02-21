<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Link Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Link CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Menambahkan link ke CSS FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Link Image Title -->
    <link rel="shortcut icon" href="/img/logo-smp.png">
    <!-- Tambahkan Sweet Alert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Tambahkan Sweet Alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Title Web -->
    <title>Siponsi - Siswa</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light py-3 mb-0">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/" style="color:#574874">
                <img src="img/logo-smp.png" style="width: 25px;" alt="" class=""> SIPONSI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page === 'Home') ? 'active' : '' ?>" href="/">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page === 'Poin') ? 'active' : '' ?>" href="/poin-saya">
                            Lihat Poin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page === 'Bootcamp') ? 'active' : '' ?>"
                            href="/daftar-bootcamp">
                            Daftar Bootcamp
                        </a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            $session = session();
                            $namaPengguna = $session->get('nama');
                            echo $namaPengguna;
                            ?>
                        </a>
                        <div class="dropdown-menu py-0 rounded-3" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i
                                    class="fa-solid fa-user" style="color: #000000;"></i> Profil</a>
                            <a class="dropdown-item text-light rounded-bottom-3" style="background-color: #6946DD;"
                                href="/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profil Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Nama: <span id="nama">
                            <?php
                            $session = session();
                            $namaPengguna = $session->get('nama');
                            echo $namaPengguna;
                            ?>
                        </span></p>
                    <p>Kelas: <span id="kelas">
                            <?php
                            $session = session();
                            $kelas = $session->get('kelas');
                            echo $kelas;
                            ?>
                        </span></p>
                    <p>Tipe: <span id="tipe">
                            <?php
                            $session = session();
                            $tipe = $session->get('tipe');
                            echo $tipe;
                            ?>
                        </span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-0 mb-0" style="border: 2px solid #574874;">

    <?php if (session()->has('pesan_selamat_datang')): ?>
        <div class="alert alert-success text-center">
            <?= session('pesan_selamat_datang') ?>
        </div>
    <?php endif; ?>

    <div class="contain">
        <div>
            <?php
            if ($page) {
                echo view($page);
            }
            ?>
        </div>
    </div>

    <div style="height:40px; background-color:#6946DD"></div>

    <!-- Link JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.7/dist/sweetalert2.all.min.js"></script>
</body>

</html>