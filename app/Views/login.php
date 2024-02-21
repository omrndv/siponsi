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
    <!-- LINK CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Menambahkan link ke CSS FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="/img/logo-smp.png">
    <style>
        .image-container {
            display: inline-block;
            background-color: white;
            border-radius: 50%;
            padding: 5px;
        }

        .image-container img {
            width: 50px;
            border-radius: 50%;
        }

        .input-icon {
            position: relative;
        }

        .user {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #000;
        }

        .pass {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #000;
        }
        .mata {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #000;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            padding-left: 30px;
        }
    </style>
    <title>Login Guru - Siponsi</title>
</head>

<body style="background-color:#6946DD">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-sm-12 col-md-6 offset-md-3">
                <div class="row">
                    <div class="col-lg-12 mt-2 text-center">
                        <div class="image-container mt-5">
                            <img src="/img/logo-smp.png" alt="" style="width:80px">
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mx-auto">
                    <div class="col-lg-10 mt-3 offset-lg-1">
                        <h2 class="fw-bold text-white pt-1">SIPONSI - GURU</h2>
                        <p class="text-white">Sistem Pencatatan Poin dan Presensi</p>
                        <form action="/login" method="POST">
                            <div class="mb-3 input-icon">
                                <i class="fa-solid user fa-user"></i>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" name="username" placeholder="Username">
                            </div>
                            <div class="mb-3 input-icon">
                                <i class="fa-solid pass fa-lock" style="color: #000000;"></i>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                    placeholder="Password">
                                <span><i class="fa-solid mata fa-eye-slash" id="togglePassword"
                                        style="position: absolute; top: 10px; right: 10px; cursor: pointer;"></i></span>
                            </div>
                            <div>
                                <p class="fw-bold text-white">Bukan Guru? <span><a href="/login-siswa"
                                            class="text-decoration-none text-warning">Login Siswa</a></span></p>
                            </div>
                            <button type="submit" class="btn fw-bold bg-white w-100 py-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        // Ambil pesan yang Anda tambahkan melalui 'with' dalam redirect
        const alertMessage = <?= json_encode(session('alert')) ?>;
        // Periksa apakah ada pesan yang diterima
        if (alertMessage) {
            Swal.fire({
                icon: 'error',  // Ganti sesuai kebutuhan Anda (error, success, warning, info, dll)
                title: 'Peringatan',
                text: alertMessage
            });
        };

        const passwordInput = document.getElementById("exampleInputPassword1");
        const togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.classList.remove("fa-eye-slash");
                togglePassword.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                togglePassword.classList.remove("fa-eye");
                togglePassword.classList.add("fa-eye-slash");
            }
        });

    </script>
</body>

</html>