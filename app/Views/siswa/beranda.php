<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-5 mt-4 col-sm-12">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mt-5 fw-bold">TENTANG SIPONSI</h1>
                </div>
                <div class="col-lg-12 mt-3">
                    <p>Website ini akan menunjukkan Anda data tentang poin pelanggaran dan presensi untuk setiap
                        siswa. Poin dan presensi hanya bisa dilihat pada akun masing-masing.</p>
                </div>
            </div>
        </div> 
        <div class="col-lg-6 offset-lg-1 mt-4 col-sm-12 mb-5">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mt-5 fw-semibold">Kotak Aduan</h5>
                    <form class="mt-3" method="post" action="<?= site_url('/up-aduan'); ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama :</label>
                            <input type="text" class="form-control" id="nama" name="nama" required
                                placeholder="Masukkan nama anda..">
                        </div>
                        <div class="mb-3">
                            <label for="kelasJabatan" class="form-label">Kelas/Jabatan :</label>
                            <input type="text" class="form-control" id="kelasJabatan" name="kelas/jabatan" required
                                placeholder="Masukkan kelas/jabatan anda..">
                        </div>
                        <div class="mb-3">
                            <label for="isiAduan" class="form-label">Isi Aduan :</label>
                            <textarea class="form-control" id="isiAduan" name="isi" required
                                placeholder="Masukkan isi aduan anda.." style="height: 100px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary fw-bold px-5"
                            style="background-color:#6946DD">KIRIM</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showSuccessAlertAndRefresh() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data berhasil dikirim!',
        }).then(() => {
            location.reload();
        });
    }
    function showErrorAlert() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Data gagal dikirim!',
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(form);
            fetch(form.action, {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showSuccessAlertAndRefresh();
                    } else {
                        showErrorAlert();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorAlert();
                });
        });
    });
</script>