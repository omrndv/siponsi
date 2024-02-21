<style>
    .table-container {
        max-height: 300px;
        overflow-y: scroll;
    }
</style>

<div class="container my-4">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <h1 class="text-center fw-bold">REKAP TUGAS</h1>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="row mb-2">
                <div class="col-lg-10 col-sm-12 col-md-9">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari Judul Tugas..">
                        <input type="text" class="form-control" id="searchInput2"
                            placeholder="Cari Tugas Berdasarkan Tanggal..">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 offset-sm-8 offset-lg-0 col-md-3 offset-md-0">
                    <button type="button" class="btn btn-danger mt-xl-0 mt-lg-0 mt-md-0 mt-sm-2"
                        onclick="konfirmasiHapusMultiple()"><i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                        Hapus Terpilih</button>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="table-container">
                <form id="delete-form" action="<?= site_url('Guru/hapus_multiple_tugas') ?>" method="post">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Judul Tugas</th>
                                <th class="text-center">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sortedTugas = array_reverse($tugas);

                            foreach ($sortedTugas as $row): ?>
                                <tr>
                                    <td class="text-center checkbox-center">
                                        <!-- Tambahkan class "checkbox-center" di sini -->
                                        <input type="checkbox" name="admins_to_delete[]" value="<?= $row['id'] ?>">
                                    </td>
                                    <td class="text-center">
                                        <?php echo nl2br(htmlspecialchars_decode($row['isi'])); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        // Mengubah format tanggal ke "Sabtu, 21 Oktober 2023"
                                        $timestamp = strtotime($row['tanggal']);
                                        $formattedDate = strftime('%A, %d %B %Y', $timestamp);

                                        // Ganti nama hari dan bulan dalam bahasa Inggris dengan bahasa Indonesia
                                        $replace = array(
                                            'Monday' => 'Senin',
                                            'Tuesday' => 'Selasa',
                                            'Wednesday' => 'Rabu',
                                            'Thursday' => 'Kamis',
                                            'Friday' => 'Jumat',
                                            'Saturday' => 'Sabtu',
                                            'Sunday' => 'Minggu',
                                            'January' => 'Januari',
                                            'February' => 'Februari',
                                            'March' => 'Maret',
                                            'April' => 'April',
                                            'May' => 'Mei',
                                            'June' => 'Juni',
                                            'July' => 'Juli',
                                            'August' => 'Agustus',
                                            'September' => 'September',
                                            'October' => 'Oktober',
                                            'November' => 'November',
                                            'December' => 'Desember',
                                        );

                                        echo strtr($formattedDate, $replace);
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const searchInput2 = document.getElementById("searchInput2");
        const tableRows = document.querySelectorAll(".table-container table tbody tr");

        searchInput.addEventListener("keyup", function () {
            toggleSearchInputs();
            searchTable(1, searchInput.value);
        });

        searchInput2.addEventListener("keyup", function () {
            toggleSearchInputs();
            searchTable(2, searchInput2.value);
        });

        function toggleSearchInputs() {
            const searchInputValue = searchInput.value.trim();
            const searchInput2Value = searchInput2.value.trim();

            if (searchInputValue !== "") {
                searchInput2.disabled = true;
            } else if (searchInput2Value !== "") {
                searchInput.disabled = true;
            } else {
                searchInput.disabled = false;
                searchInput2.disabled = false;
            }
        }

        function searchTable(columnIndex, query) {
            query = query.toLowerCase();

            tableRows.forEach(function (row) {
                const cell = row.getElementsByTagName("td")[columnIndex];
                if (cell) {
                    const cellText = cell.textContent || cell.innerText;
                    if (cellText.toLowerCase().indexOf(query) > -1) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
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
                title: 'Apakah Anda yakin ingin menghapus data tugas terpilih?',
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