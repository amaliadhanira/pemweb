<div class="container mt-5">
    <div class="col col-md-12 p-3">
        <h1>Data Laporan</h1>
        <?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
        <div class="float-left"><button class="btn btn-sm btn-primary" id="tambah_laporan">Buat laporan</button></div>
            <table class="table table-hover" id="table_laporan" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No. Antrean</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Tanggal Periksa</th>
                        <th scope="col">Diagnosa</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
    </div>
</div>

<!-- MODAL RINCIAN -->
<div class="modal fade" id="modal_rincian_laporan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_laporan_label">Rincian Laporan Pemeriksaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th scope="row" style="width: 50%">No. Antrean:</th>
                        <td id="no_antrean"></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 50%">Nama Pasien:</th>
                        <td id="nama_pasien"></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 50%">Nama Dokter:</th>
                        <td id="nama_dokter"></td>
                    </tr>
                    <tr>
                        <th scope="row">Spesialis:</th>
                        <td id="spesialis"></td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Periksa:</th>
                        <td id="tgl_periksa"></td>
                    </tr>
                    <tr>
                        <th scope="row">Diagnosa:</th>
                        <td id="diagnosa"></td>
                    </tr>
                    <tr>
                        <th scope="row">Resep Obat:</th>
                        <td>
                            <ul id="obat"></ul>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH / UBAH laporan -->
<div class="modal fade" id="modal_laporan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_laporan_label">Form laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="" id="form_laporan" class="form-horizontal">
                    <input type="hidden" name="id_laporan" value="">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="no_antrean" class="col-form-label">Nomor Antrean:</label>
                            <input type="text" name="no_antrean" class="form-control" placeholder="Nomor Antrean">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama_pasien" class="col-form-label">Nama Pasien:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="dokter" class="col-form-label">Dokter:</label>
                            <select name="dokter" id="dokter" class="form-control">
                                <?php foreach ($dokter as $dok) { ?>
                                    <option value="<?= $dok['id_dokter'] ?>"><?= $dok['nama_dokter']. ' - ' .$dok['nama_spesialisasi'] ?></option>
                                <?php 
                                $val_id_dok = $dok['id_dokter'];
                            } ?>
                            </select>
                            <input type="hidden" name="id_dokter" value="">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="tgl_periksa" class="col-form-label">Tanggal Periksa:</label>
                            <input type="text" name="tgl_periksa" class="form-control" placeholder="Tanggal Periksa">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="diagnosa" class="col-form-label">Diagnosa:</label>
                            <input type="text" name="diagnosa" class="form-control" placeholder="Diagnosa">
                            <span class="help-block"></span>
                        </div>
                       
                        <div class="form-group">
                            <label for="resep_obat" class="col-form-label">Resep Obat:</label>
                            <textarea name="resep_obat" class="form-control" placeholder="Resep Obat">
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