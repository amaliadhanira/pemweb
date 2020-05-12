<div class="container mt-5">
    <div class="col col-md-12 p-3">
        <h1>Data Laporan</h1>
        <?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
        <div class="float-left p-1"><button class="btn btn-sm btn-primary" id="buat_laporan">Buat Laporan</button></div>
            <table class="table table-hover" id="table_laporan" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No. Antrean</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Tanggal Periksa</th>
                        <th scope="col" style="width: 25%">Diagnosa</th>
                        <th scope="col" style="width: 25%">Resep Obat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
    </div>
</div>

<!-- MODAL TAMBAH / UBAH LAPORAN -->
<div class="modal fade" id="modal_laporan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_laporan_label">Form Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="" id="form_laporan" class="form-horizontal">
                    <input type="hidden" name="id_laporan" value="">
                    <div class="form-body">
                        <div class="form-group">
                            <input type="hidden" name="no_antrean" id="no_antrean" value="0">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama_pasien" class="col-form-label">Nama Pasien:</label>
                            <input type="text" name="nama_pasien" class="form-control disabled" placeholder="Nama Pasien" disabled>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama_dokter" class="col-form-label">Nama Dokter:</label>
                            <input type="text" name="nama_dokter" class="form-control disabled" placeholder="Nama Dokter" disabled>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama_spesialisasi" class="col-form-label">Spesialis:</label>
                            <input type="text" name="nama_spesialisasi" class="form-control disabled" placeholder="Spesialis" disabled>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="tgl_periksa" class="col-form-label">Tanggal Periksa:</label>
                            <input type="text" name="tgl_periksa" class="form-control disabled" placeholder="Tanggal Periksa" disabled>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="diagnosa" class="col-form-label">Diagnosa:</label>
                            <textarea name="diagnosa" class="form-control" placeholder="Diagnosa"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="resep_obat" class="col-form-label">Resep Obat:</label>
                            <textarea name="resep_obat" class="form-control" placeholder="Resep Obat"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_simpan_laporan" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>