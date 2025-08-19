<div class="modal fade" id="tamuMhs" tabindex="-1" role="dialog" aria-labelledby="tamuMhsTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tamuMhsTitle">Tamu Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTamuMhs">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="inputNim" name="nim"
                                placeholder="Masukan Nim dan klik cek nim">
                            <div class="input-group-prepend">
                                <button class="btn btn-primary rounded-right" type="button" id="cekNimBtn">Cek
                                    NIM</button>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namaMhs" placeholder="Masukan Nama Lengkap"
                            name="namaMhs">
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fakultas">Fakultas</label>
                            <input type="text" class="form-control" id="fakultas" placeholder="Masukan Fakultas"
                                name="fakultas">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" placeholder="Masukan Jurusan"
                                name="jurusan">
                        </div>

                    </div>



                    <div class="form-group">
                        <label for="tanggal_mhs">Hari/Tanggal</label>


                        <input type="text" class="form-control" id="tanggal_mhs_display" readonly>
                        {{-- <small class="form-text text-muted"></small> --}}

                        <!-- Yang akan dikirim ke server -->
                        <input type="hidden" name="tanggal_mhs" id="tanggal_mhs">
                    </div>


                    <div class="form-row">
                        <!-- Dropdown Profesi -->
                        <div class="form-group col-md-6">
                            <label for="bertemu_dengan_mhs" class="mr-2 mb-0"
                                style="width: 120px; white-space: nowrap;">
                                Bertemu Dengan
                            </label>
                            <select class="form-control" id="bertemu_dengan_mhs" name="profesi">
                                <option value="" selected disabled>Pilih Profesi</option>
                                <option value="pengurus">Pengurus</option>
                                <option value="pegawai">Pegawai</option>
                            </select>
                        </div>

                        <!-- Dropdown yang diubah berdasarkan profesi -->
                        <div class="form-group col-md-6">
                            <label class="mr-2 mb-0 text-white" style="width: 120px;">.</label>
                            <select class="form-control" id="pihak_dituju_mhs" name="tujuan_mhs"
                                placeholder="Silahkan ketik tujuan kunjungan">
                                <option disabled selected>Pilih Pihak yang Dituju</option>
                            </select>
                        </div>
                    </div>





                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Keperluan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 71px;"
                            placeholder="masukan keperluan..." name="keperluan_mhs"></textarea>
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
