<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 2px solid black;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f0f0f0;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
<div class="container text-center mb-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-sm-12">
            <h1 class="fw-bold mt-5">REKAP PRESENSI DAN POIN</h1>
            <h5 class="fw-semibold">KELAS
                <?php
                $session = session();
                $namakelas = $session->get('kelas');
                echo $namakelas;
                ?>
            </h5>
        </div>
        <div class="col-lg-2 col-sm-4 offset-sm-8">
            <a href="/daftar-absensi" class="btn mt-4 px-3 py-2 fw-semibold btn-primary">Lihat Absensi</a>
        </div>
        <div class="col-lg-8 offset-lg-2 mt-5">
            <table>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Poin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td>
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $student['nama']; ?>
                            </td>
                            <td>
                                <?= $student['kelas']; ?>
                            </td>
                            <td>
                                <?= $student['poin']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>