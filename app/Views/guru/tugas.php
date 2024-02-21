<style>
    .fullscreen-textarea {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        visibility: hidden;
    }

    .textarea-container {
        background-color: #fff;
        width: 80%;
        height: 80%;
        padding: 20px;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
    }

    #fullscreenTugas {
        flex: 1;
    }
</style>

<div class="container mb-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="fw-bold mt-5">UPLOAD TUGAS</h1>
            <p>Silahkan Upload Tugas Disini</p>
        </div>
        <div class="col-12">
            <form action="<?= site_url('/updatetugas'); ?>" method="post">
                <div class="form-group">
                    <textarea class="form-control" id="tugas" name="isi" rows="12"></textarea>
                </div>
                <input type="hidden" name="tanggal" id="tanggal_jam" value="">
                <div class="mt-4">
                    <button type="button" class="btn btn-primary" id="toggleFullScreen">Mode Layar Penuh</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="fullscreenTextarea" class="fullscreen-textarea">
    <div class="textarea-container">
        <textarea class="form-control" id="fullscreenTugas"></textarea>
        <button type="button" class="btn btn-danger" id="exitFullscreen">Keluar</button>
    </div>
</div>

<script>
    let originalTextarea = document.getElementById("tugas");
    let fullscreenTextarea = document.getElementById("fullscreenTugas");

    document.getElementById("toggleFullScreen").addEventListener("click", function () {
        fullscreenTextarea.value = originalTextarea.value;
        document.getElementById("fullscreenTextarea").style.visibility = "visible";
        fullscreenTextarea.focus();
    });

    document.getElementById("exitFullscreen").addEventListener("click", function () {
        originalTextarea.value = fullscreenTextarea.value;
        document.getElementById("fullscreenTextarea").style.visibility = "hidden";
    });

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