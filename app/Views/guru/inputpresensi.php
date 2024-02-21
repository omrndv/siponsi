<style>
    .table-container {
        max-height: 300px;
        overflow-y: scroll;
    }
</style>

<div class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="h1 text-center fw-bold">DAFTAR ABSEN KELAS
                    <span>
                        <?= session()->get('kelas'); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="input-group mt-5 mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari siswa...">
        </div>

        <form method="post" action="<?= site_url('/simpan-presensi'); ?>">
            <input type="hidden" name="tipe" value="Siswa">
            <input type="hidden" name="kelas" value="<?= session()->get('kelas'); ?>">

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Hadir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($siswa as $data) { ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++ ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $data['nama'] ?>
                                        <input type="hidden" name="nama[<?= $data['id'] ?>]" value="<?= $data['nama'] ?>">
                                    </td>
                                    <td class="text-center">
                                        <?= $data['kelas'] ?>
                                    </td>
                                    <td class="text-center">
                                        <select name="status[<?= $data['id'] ?>]" class="form-control">
                                            <option value="Hadir">Hadir</option>
                                            <option value="Sakit">Sakit</option>
                                            <option value="Alpha">Alpha</option>
                                            <option value="Izin">Izin</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-end fw-bold mb-5 mt-2">
                <button type="submit" class="btn px-5 fw-semibold btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    const alertMessage = <?= json_encode(session('alert')) ?>;
    if (alertMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: alertMessage
        });
    }

    <?php if (session()->has('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session('error') ?>'
        });
    <?php } ?>

    document.getElementById("searchInput").addEventListener("keyup", function () {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table-container");
        tr = table.querySelector("table tbody").getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>