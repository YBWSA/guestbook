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
                <form>
                    <div class="form-group">
                        <label for="namaLengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namaLengkap" placeholder="Masukan Nama Lengkap"
                            name="nama">
                        {{-- <small class="form-text text-muted"></small> --}}
                    </div>

                    <div class="form-group">
                        <label for="nip">No Hp</label>
                        <input type="text" class="form-control" id="no_hp" placeholder="Masukan No Hp"
                            name="no_hp">
                        {{-- <small class="form-text text-muted"></small> --}}
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

                    <div class="form-group">
                        <label for="tanggal_luar">Hari/Tanggal</label>
                        <input type="text" class="form-control" id="tanggal_luar" placeholder="Masukan Tanggal"
                            name="tanggal_luar" readonly>
                        {{-- <small class="form-text text-muted"></small> --}}
                    </div>


                    <div class="form-row">
                        <!-- Kiri -->
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect12" class="mr-2 mb-0"
                                style="width: 120px; white-space: nowrap;">
                                Bertemu Dengan
                            </label>
                            <select class="form-control" id="exampleFormControlSelect12" name="bertemu_dengan">
                                <option>Pengurus</option>
                                <option>Pegawai</option>
                            </select>
                        </div>

                        <!-- Kanan -->
                        <div class="form-group col-md-6">
                            <label for="pilih_t" class="mr-2 mb-0" style="width: 120px;"></label>
                            <input type="text" class="form-control" id="pilih_t" placeholder="Pilih Tujuan"
                                name="pilih_t">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlSelect12">Tujuan Kunjungan</label>
                        <select class="form-control" id="exampleFormControlSelect12">
                            <option>Dinas</option>
                            <option>Pribadi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Keperluan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 71px;"
                            placeholder="isi keperluan"></textarea>
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
