<div class="container mb-5">
    <h1 class="fw-bold text-center my-4">DETAIL SISWA</h1>
    <form class="mt-3" method="post" action="<?= site_url('/update-poin'); ?>">
        <div class="form-group mb-3">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" readonly>
        </div>

        <div class="form-group mb-3">
            <label for="kelas">Kelas:</label>
            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $kelas ?>" readonly>
        </div>

        <div class="form-group mb-3">
            <p>Pilih Pelanggaran:</p>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="kehadiran" name="poin[]" value="5">
                <label class="form-check-label" for="kehadiran">Kehadiran</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="pakaian" name="poin[]" value="3">
                <label class="form-check-label" for="pakaian">Pakaian</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rambut" name="poin[]" value="5">
                <label class="form-check-label" for="rambut">Rambut, Kuku, Wajah, dan Mata</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="perusakan" name="poin[]" value="25">
                <label class="form-check-label" for="perusakan">Tindakan perusakan</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rokok" name="poin[]" value="15">
                <label class="form-check-label" for="rokok">Membawa Rokok atau Merokok</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="napza" name="poin[]" value="50">
                <label class="form-check-label" for="napza">Membawa, Menggunakan dan Memperjualbelikan NAPZA</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="minuman" name="poin[]" value="30">
                <label class="form-check-label" for="minuman">Membawa atau Mengkonsumsi Minuman Beralkohol</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="benda" name="poin[]" value="30">
                <label class="form-check-label" for="benda">Membawa Benda Berbahaya</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="perkelahian" name="poin[]" value="30">
                <label class="form-check-label" for="perkelahian">Perkelahian</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="pencurian" name="poin[]" value="50">
                <label class="form-check-label" for="pencurian">Pencurian dan Tindakan Kriminal</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="etika" name="poin[]" value="15">
                <label class="form-check-label" for="etika">Etika</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="admin" name="poin[]" value="15">
                <label class="form-check-label" for="admin">Administrasi Sekolah</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="kendaraan" name="poin[]" value="10">
                <label class="form-check-label" for="kendaraan">Kendaraan</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="kesusilaan" name="poin[]" value="50">
                <label class="form-check-label" for="kesusilaan">Kesusilaan</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    const errorMessage = <?= json_encode(session('error')) ?>;
    const successMessage = <?= json_encode(session('success')) ?>;

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: errorMessage
        });
    } else if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: successMessage
        }).then(() => {
            location.reload();
        });
    }
</script>