<style>
    .table-container {
        max-height: 250px;
        overflow-y: scroll;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="fw-bold text-center my-5">KOTAK ADUAN</h2>

            <div class="row mb-2">
                <div class="col-lg-10 col-sm-12 col-md-9">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari data aduan..">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 offset-sm-8 offset-lg-0 col-md-3 offset-md-0">
                    <button type="button" class="btn btn-danger mt-xl-0 mt-lg-0 mt-md-0 mt-sm-2"
                        onclick="konfirmasiHapusMultiple()"><i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                        Hapus Terpilih</button>
                </div>
            </div>

            <form id="delete-form" action="<?= site_url('Admin/hapus_multiple_admin') ?>" method="post">
                <div class="table-container">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Kelas / Jabatan</th>
                                    <th>Isi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($aduanData as $aduan): ?>
                                    <tr data-rowId="<?= $aduan['id']; ?>">
                                        <td>
                                            <input type="checkbox" name="admins_to_delete[]" value="<?= $aduan['id'] ?>">
                                        </td>
                                        <td>
                                            <?= $aduan['nama']; ?>
                                        </td>
                                        <td>
                                            <?= $aduan['kelas/jabatan']; ?>
                                        </td>
                                        <td>
                                            <?= $aduan['isi']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$response = session()->getFlashdata('response');
if ($response && $response['status'] === 'success'):
    ?>
    <script>
        Swal.fire({
            title: "Sukses!",
            text: "<?= $response['message']; ?>",
            icon: "success",
            button: "OK",
        });
    </script>
<?php endif; ?>

<script>
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
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('input[name="admins_to_delete[]"]');

    selectAllCheckbox.addEventListener('change', () => {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    function konfirmasiHapusMultiple() {
        const selectedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);

        if (selectedCheckboxes.length === 0) {
            Swal.fire({
                title: 'Tidak ada data yang dipilih',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data aduan terpilih?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteForm = document.getElementById('delete-form');
                    const formData = new FormData(deleteForm);

                    fetch(deleteForm.action, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        }
    }
</script>