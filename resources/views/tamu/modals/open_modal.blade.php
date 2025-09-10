<style>
    .row {
        gap: 1.5rem;
        /* Jarak antar kartu */
        flex-wrap: wrap;
        /* Biar bisa pindah baris kalau sempit */
    }

    .card-guest {
        width: 100%;
        max-width: 260px;
    }
</style>

<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center ">
        {{-- Tamu Internal --}}
        <div class="card mb-4 card-default card-guest">
            <div class="card-header card-header-border-bottom d-flex flex-column align-items-center">
                <!-- SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-person-fill-down" viewBox="0 0 16 16">
                    <path
                        d="M12.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m.354 5.854 1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V10.5a.5.5 0 0 0-1 0v2.793l-.646-.647a.5.5 0 0 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path
                        d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                </svg>
            </div>
            <div class="card-body text-center">
                <h5>Tamu Internal</h5>


            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-info btn-pill" data-toggle="modal" data-target="#tamuInternal">
                    Isi Data
                </button>
            </div>
        </div>



        {{-- Tamu Eksternal --}}

        <div class="card mb-4 card-default card-guest">
            <div class="card-header card-header-border-bottom d-flex flex-column align-items-center">
                <!-- SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-person-fill-up" viewBox="0 0 16 16">
                    <path
                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path
                        d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                </svg>
            </div>
            <div class="card-body text-center">
                <h5>Tamu Luar</h5>


            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-info btn-pill" data-toggle="modal" data-target="#tamuEksternal">
                    Isi Data
                </button>
            </div>
        </div>

        {{-- Tamu Mahasiswa --}}


        <div class="card mb-4 card-default card-guest">
            <div class="card-header card-header-border-bottom d-flex flex-column align-items-center">
                <!-- SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                    <path
                        d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                </svg>
            </div>
            <div class="card-body text-center">
                <h5>Tamu Mahasiswa</h5>


            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-info btn-pill" data-toggle="modal" data-target="#tamuMhs">
                    Isi Data
                </button>
            </div>
        </div>
    </div>
</div>
