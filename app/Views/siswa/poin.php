<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="fw-bold mt-4 text-center">POIN SAYA</h1>
        </div>
        <div class="col-12 mt-5">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>
                        <?php echo session()->get('nama'); ?>
                    </td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>
                        <?php echo session()->get('kelas'); ?>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah poin</th>
                    <td>
                        <?php echo session()->get('poin'); ?>
                    </td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>
                        <?php
                        $poin = session()->get('poin');
                        if ($poin < 1) {
                            echo "Kamu termasuk ke dalam kategori hijau atau tidak ada pelanggaran tata tertib.";
                        } elseif ($poin >= 1 && $poin < 75) {
                            echo "Kamu termasuk ke dalam kategori kuning atau pelanggaran tata tertib tipe sedang.";
                        } else {
                            echo "Kamu termasuk ke dalam kategori merah atau pelanggaran tata tertib tipe berat.";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>