<!-- guru/bootcamp -->
<div class="container mb-5">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 2px solid black;
            padding: 8px;
            text-align: center;
        }

        tr:hover td {
            background-color: #f0f0f0;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="fw-bold mt-5 text-center">DAFTAR BOOTCAMP</h1>
            <p class="text-center mt-2 fw-semibold">Berikut ini adalah siswa-siswa yang mengikuti bootcamp pembinaan
                karakter:</p>
        </div>
        <div class="col-lg-8 offset-lg-2 mt-5">
            <table>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($students as $student) {
                        echo '<tr>';
                        echo '<td>' . $no++ . '</td>';
                        echo '<td>' . $student['nama'] . '</td>';
                        echo '<td>' . $student['kelas'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>