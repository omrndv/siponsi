<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h2 class="fw-bold">PILIH TANGGAL ABSENSI</h2>
            <form id="absensiForm">
                Pilih Tanggal: <input type="date" name="tanggal" id="tanggal" required>
                <input type="button" value="Lihat Absensi" onclick="lihatAbsensi()">
            </form>
        </div>
        <div class="input-group mb-0 mt-4">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari siswa...">
        </div>
        <div class="col-12 mt-1 mb-5">
            <div id="absensiTable" class="table-container">
                <table class="table table-bordered table-sm">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="absensiData"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function lihatAbsensi() {
        const tanggal = document.getElementById('tanggal').value;
        const absensiData = document.getElementById('absensiData');

        fetch(`/absensi/lihat/${tanggal}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    absensiData.innerHTML = '<tr><td colspan="5" class="text-center py-5">Maaf, data tidak tersedia.</td></tr>';
                } else {
                    let tableHTML = '';
                    data.forEach((item, index) => {
                        const rawDate = new Date(item.tanggal);
                        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        const formattedDate = rawDate.toLocaleDateString('id-ID', options);

                        tableHTML += '<tr>';
                        tableHTML += `<td class="text-center">${index + 1}</td>`;
                        tableHTML += `<td>${item.nama}</td>`;
                        tableHTML += `<td class="text-center">${item.kelas}</td>`;
                        tableHTML += `<td class="text-center">${formattedDate}</td>`;
                        tableHTML += `<td class="text-center">${item.status}</td>`;
                        tableHTML += '</tr>';
                    });

                    absensiData.innerHTML = tableHTML;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    
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