<style>
    .scrollable-table-container {
        max-height: 300px;
        overflow-y: scroll;
    }
</style>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="fw-bold text-center my-5">DATA SISWA</h2>

            <div class="row mb-2">
                <div class="col-lg-8">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari data siswa..">
                    </div>
                </div>
                <div class="col-lg-2 text-end">
                    <button type="button" class="btn btn-primary mt-xl-0 mt-lg-0 mt-md-0 mt-sm-2"
                        onclick="openAddStudentModal()">
                        <i class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah Data
                    </button>
                </div>
                <div class="col-lg-2 text-end">
                    <button type="button" class="btn btn-danger mt-xl-0 mt-lg-0 mt-md-0 mt-sm-2"
                        onclick="konfirmasiHapusMultiple()"><i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                        Hapus Terpilih</button>
                </div>
            </div>

            <form id="delete-form" action="<?= site_url('Admin/hapus_multiple_siswa') ?>" method="post">
                <div class="scrollable-table-container">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tipe</th>
                                    <th>Poin</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1; 
                                foreach ($datsisData as $row):
                                    ?>
                                    <tr data-rowId="<?= $row['id']; ?>">
                                        <td>
                                            <input type="checkbox" name="admins_to_delete[]" value="<?= $row['id'] ?>">
                                        </td>
                                        <td>
                                            <?= $counter; ?>
                                        </td>
                                        <td>
                                            <?= $row['nama']; ?>
                                        </td>
                                        <td>
                                            <?= $row['kelas']; ?>
                                        </td>
                                        <td>
                                            <?= $row['tipe']; ?>
                                        </td>
                                        <td>
                                            <?= $row['poin']; ?>
                                        </td>
                                        <td>
                                            <?= $row['username']; ?>
                                        </td>
                                        <td>
                                            <?= $row['password']; ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary" onclick="openEditModal(
                                                '<?= $row['id'] ?>',
                                                '<?= $row['nama'] ?>',
                                                '<?= $row['username'] ?>',
                                                '<?= $row['password'] ?>',
                                                '<?= $row['kelas'] ?>',
                                                '<?= $row['poin'] ?>'
                                            )"><i class="fa-solid fa-pen" style="color: #ffffff;"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $counter++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" action="<?= site_url('Admin/edit_siswa') ?>" method="post">
                    <input type="hidden" name="guru_id" id="edit-guru-id">
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama Siswa</label>
                        <input type="text" name="edit_nama" id="edit-nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input type="text" name="edit_username" id="edit-username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">Password</label>
                        <input type="text" name="edit_password" id="edit-password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-kelas" class="form-label">Kelas</label>
                        <input type="text" name="edit_kelas" id="edit-kelas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-poin" class="form-label">poin</label>
                        <input type="text" name="edit_poin" id="edit-poin" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmSave()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-student-form" action="<?= site_url('Admin/tambah_siswa') ?>" method="post">
                    <input type="hidden" name="tipe" value="Siswa">
                    <div class="mb-3">
                        <label for="add-nama" class="form-label">Nama Siswa</label>
                        <input type="text" name="add_nama" id="add-nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-username" class="form-label">Username</label>
                        <input type="text" name="add_username" id="add-username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-password" class="form-label">Password</label>
                        <input type="text" name="add_password" id="add-password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-kelas" class="form-label">Kelas</label>
                        <input type="text" name="add_kelas" id="add-kelas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-poin" class="form-label">Poin</label>
                        <input type="text" name="add_poin" id="add-poin" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmAdd()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".scrollable-table-container");
        tr = table.querySelector("table tbody").getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
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
                title: 'Apakah Anda yakin ingin menghapus data siswa terpilih?',
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

<script>
    function openEditModal(id, nama, username, password, kelas, poin) {
        const editForm = document.getElementById('edit-form');
        document.getElementById('edit-guru-id').value = id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-username').value = username;
        document.getElementById('edit-password').value = password;
        document.getElementById('edit-kelas').value = kelas;
        document.getElementById('edit-poin').value = poin;

        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }

    function confirmSave() {
        const editForm = document.getElementById('edit-form');

        const namaValue = document.getElementById("edit-nama").value;
        const usernameValue = document.getElementById("edit-username").value;
        const passwordValue = document.getElementById("edit-password").value;
        const kelasValue = document.getElementById('edit-kelas').value;
        const poinValue = document.getElementById('edit-poin').value;

        if (namaValue === '' || usernameValue === '' || passwordValue === '') {
            Swal.fire({
                title: 'Data tidak boleh ada yang kosong!',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            });
            return false;
        }

        Swal.fire({
            title: 'Konfirmasi perubahan data',
            text: 'Anda yakin ingin menyimpan perubahan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                editForm.submit();
            }
        });
    }
    function openAddStudentModal() {
        const addStudentModal = new bootstrap.Modal(document.getElementById('addStudentModal'));
        addStudentModal.show();
    }

    function confirmAdd() {
        const addStudentForm = document.getElementById('add-student-form');

        Swal.fire({
            title: 'Konfirmasi penambahan data',
            text: 'Anda yakin ingin menambahkan data siswa baru?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                addStudentForm.submit();
            }
        });
    }

</script>

<?php $response = session()->getFlashdata('response'); ?>
<?php if ($response): ?>
    <?php if ($response['status'] === 'success'): ?>
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "<?= $response['message']; ?>",
                icon: "success",
                button: "OK",
            });
        </script>
    <?php elseif ($response['status'] === 'error'): ?>
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "<?= $response['message']; ?>",
                icon: "error",
                button: "OK",
            });
        </script>
    <?php endif; ?>
<?php endif; ?>