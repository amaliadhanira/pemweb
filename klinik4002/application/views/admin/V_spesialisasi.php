<div class="container mt-5">
    <div class="col col-md-12 p-3">
        <h1>Data Spesialisasi</h1>
        <?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
        <div class="float-left p-1"><button class="btn btn-sm btn-primary" id="tambah_spesialisasi">Tambah Spesialisasi</button></div>
            <table class="table table-hover" id="table_spesialisasi" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Spesialisasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
    </div>
</div>

<!-- MODAL TAMBAH / UBAH SPESIALISASI -->
<div class="modal fade" id="modal_spesialisasi" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_spesialisasi_label">Form Spesialisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="" id="form_spesialisasi" class="form-horizontal">
                    <input type="hidden" name="id_spesialisasi" value="">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="nama_spesialisasi" class="col-form-label">Nama Spesialisasi:</label>
                            <input type="text" name="nama_spesialisasi" class="form-control" placeholder="Nama Spesialisasi">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_simpan_spesialisasi" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>