<div class="modal fade" id="tamuEksternal" tabindex="-1" role="dialog" aria-labelledby="tamuEksternalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tamuEksternalTitle">Tamu Luar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTamuEksternal">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap"
                                placeholder="Masukan Nama Lengkap" name="nama">
                            {{-- <small class="form-text text-muted"></small> --}}
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nip">No Hp</label>
                            <input type="text" class="form-control" id="no_hp" placeholder="Masukan No Hp"
                                name="no_hp">
                            {{-- <small class="form-text text-muted"></small> --}}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="instansi" class="mr-2 mb-0" style="width: 120px;">Instansi</label>
                            <input type="text" class="form-control" id="instansi" placeholder="Masukan Instansi"
                                name="instansi">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="unitHomebase" class="mr-2 mb-0" style="width: 120px;">Alamat</label>
                            <input type="text" class="form-control" id="unitHomebase" placeholder="Masukan Alamat"
                                name="unit_homebase">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_luar">Hari/Tanggal</label>
                            <input type="text" class="form-control" id="tanggal_eksternal"
                                placeholder="Masukan Tanggal" name="tanggal_eksternal" readonly>
                            {{-- <small class="form-text text-muted"></small> --}}
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tujuan Kunjungan</label>
                            <select class="form-control" id="tujuan_kunjungan_eksternal"
                                name="tujuan_kunjungan_eksternal" required>
                                <option value="" selected disabled>Pilih Tujuan Kunjungan</option>
                                <option value="1">Dinas</option>
                                <option value="2">Pribadi</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-row">

                        <!-- Dropdown Profesi -->
                        <div class="form-group col-md-6">
                            <label for="bertemu_dengan_mhs" class="mr-2 mb-0"
                                style="width: 120px; white-space: nowrap;">
                                Bertemu Dengan
                            </label>
                            <select class="form-control" id="bertemu_dengan_eksternal" name="profesi">
                                <option value="" selected disabled>Pilih Profesi</option>
                                <option value="pengurus">Pengurus</option>
                                <option value="pegawai">Pegawai</option>
                            </select>
                        </div>

                        <!-- Dropdown yang diubah berdasarkan profesi -->
                        <div class="form-group col-md-6">
                            <label class="mr-2 mb-0 text-white" style="width: 120px;">.</label>
                            <select class="form-control" id="pihak_dituju_eksternal" name="id_tujuan_eksternal"
                                placeholder="Silahkan ketik tujuan kunjungan">
                                <option disabled selected>Pilih Pihak yang Dituju</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Keperluan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 71px;"
                            placeholder="masukan keperluan..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-pill">Simpan</button>
            </div>
        </div>
    </div>
</div>
