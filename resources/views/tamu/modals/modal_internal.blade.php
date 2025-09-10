<div class="modal fade" id="tamuInternal" tabindex="-1" role="dialog" aria-labelledby="tamuInternalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tamuInternalTitle">Tamu Internal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTamuInternal">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Lengkap"
                            name="nama">
                        {{-- <small class="form-text text-muted"></small> --}}
                    </div>

                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" placeholder="Masukan NIP"
                            name="nip" readonly>
                        {{-- <small class="form-text text-muted"></small> --}}
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="unit" class="mr-2 mb-0" style="width: 120px;">Unit</label>
                            <input type="text" class="form-control" id="unit" placeholder="Masukan Unit"
                                name="unit" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="unitHomebase" class="mr-2 mb-0" style="width: 120px;">Unit Homebase</label>
                            <input type="text" class="form-control" id="unitHomebase"
                                placeholder="Masukan Unit Homebase" name="unit_homebase" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_internal_display">Hari/Tanggal</label>
                            <!-- Display ke pengguna -->
                            <input type="text" class="form-control" id="tanggal_internal_display" readonly>

                            <!-- Yang akan dikirim ke server -->
                            <input type="hidden" name="tanggal_internal" id="tanggal_internal">
                        </div>



                        <div class="form-group col-md-6">
                            <label>Tujuan Kunjungan</label>
                            <select class="form-control" id="sifat_tujuan_kunjungan_internal"
                                name="sifat_tujuan_kunjungan_internal">
                                <option value="" selected disabled>Pilih Tujuan Kunjungan</option>
                                <option value="1">Dinas</option>
                                <option value="2">Pribadi</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-row">
                        <!-- Dropdown Profesi -->
                        <div class="form-group col-md-6">
                            <label for="bertemu_dengan_internal" class="mr-2 mb-0"
                                style="width: 120px; white-space: nowrap;">
                                Bertemu Dengan
                            </label>
                            <select class="form-control" id="bertemu_dengan_internal" name="profesi">
                                <option value="" selected disabled>Pilih Profesi</option>
                                <option value="pengurus">Pengurus</option>
                                <option value="pegawai">Pegawai</option>
                            </select>
                        </div>

                        <!-- Dropdown yang diubah berdasarkan profesi -->
                        <div class="form-group col-md-6">
                            <label class="mr-2 mb-0 text-white" style="width: 120px;">.</label>
                            <select class="form-control" id="pihak_dituju_internal" name="tujuan_internal"
                                placeholder="Silahkan ketik tujuan kunjungan">
                                <option disabled selected>Pilih Pihak yang Dituju</option>
                            </select>
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Keperluan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 71px;"
                            placeholder="masukan keperluan..." name="keperluan_internal"></textarea>
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
