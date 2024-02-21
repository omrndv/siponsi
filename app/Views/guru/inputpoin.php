<style>
    .table-container {
        max-height: 300px;
        overflow-y: scroll;
    }
</style>

<div class="container mt-5 mb-5">
    <h1 class="fw-bold mb-5 text-center">INPUT POIN</h1>

    <div class="input-group mb-3 mt-5">
        <input type="text" class="form-control" id="searchInput" placeholder="Cari siswa...">
    </div>

    <div class="table-container">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th class="">Nama</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Tipe</th>
                    <th class="text-center">Poin</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td>
                            <?= $student['nama'] ?>
                        </td>
                        <td>
                            <?= $student['kelas'] ?>
                        </td>
                        <td>
                            <?= $student['tipe'] ?>
                        </td>
                        <td>
                            <?= $student['poin'] ?>
                        </td>
                        <td>
                            <a href="/detailsiswa?nama=<?= $student['nama'] ?>&kelas=<?= $student['kelas'] ?>"
                                class="btn btn-primary">Update Poin</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table-container");
        tr = table.querySelector("table tbody").getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; 
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