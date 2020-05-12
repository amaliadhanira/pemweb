<div class="container mt-5">
    <div class="col col-md-12 p-3">
        <h1>Data Dokter</h1>
        <?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
        <div class="float-left p-1"><button class="btn btn-sm btn-primary" id="tambah_dokter">Tambah Dokter</button></div>
        <div class="float-left p-1"><a href="<?= site_url('adminpage/spesialisasi') ?>" class="btn btn-sm btn-primary" id="kelola_spesialisasi">Kelola Spesialisasi</a></div>
            <table class="table table-hover" id="table_dokter" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Jadwal</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
    </div>
</div>

<!-- MODAL TAMBAH / UBAH DOKTER -->
<div class="modal fade" id="modal_dokter" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_dokter_label">Form Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="" id="form_dokter" class="form-horizontal">
                    <input type="hidden" name="id_dokter" value="">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="nama_dokter" class="col-form-label">Nama Dokter:</label>
                            <input type="text" name="nama_dokter" class="form-control" placeholder="Nama Lengkap">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="col-form-label">Spesialis:</label>
                            <select name="spesialisasi" id="spesialisasi" class="form-control">
                                <?php foreach ($spesialisasi as $spe) { ?>
                                    <option value="<?= $spe['id_spesialisasi'] ?>"><?= $spe['nama_spesialisasi'] ?></option>
                                <?php 
                            } ?>
                            </select>
                            <input type="hidden" name="id_spesialisasi" value="">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="jadwal" class="col-form-label">Jadwal:</label>
                            <input type="text" name="jadwal" class="form-control" placeholder="Jadwal">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="col-form-label">Nomor Telepon:</label>
                            <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_simpan_dokter" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>