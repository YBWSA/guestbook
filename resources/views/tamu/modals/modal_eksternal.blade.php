<div class="modal fade" id="tamuEksternal" tabindex="-1" role="dialog" aria-labelledby="tamuEksternalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tamuEksternalTitle">Tamu Luar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTamuEksternal">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_eksternal"
                                placeholder="Masukan Nama Lengkap" name="nama_eksternal">
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
                                name="alamat">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_luar">Hari/Tanggal</label>
                            <!-- Display ke pengguna -->
                            <input type="text" class="form-control" id="tanggal_eksternal_display" readonly>

                            <input type="hidden" id="tanggal_eksternal" name="tanggal_eksternal">
                            {{-- <small class="form-text text-muted"></small> --}}
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tujuan Kunjungan</label>
                            <select class="form-control" id="sifat_tujuan_kunjungan_eksternal"
                                name="sifat_tujuan_kunjungan_eksternal">
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
                            <select class="form-control" id="pihak_dituju_eksternal" name="tujuan_eksternal"
                                placeholder="Silahkan ketik tujuan kunjungan">
                                <option disabled selected>Pilih Pihak yang Dituju</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Keperluan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 71px;"
                            placeholder="masukan keperluan..." name="keperluan_eksternal"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-pill">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
