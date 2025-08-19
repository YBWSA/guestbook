@extends('layoutes.main')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4 mt-4">Tamu Internal</h2>

        <table class="table table-striped table-bordered" style="border: 2px solid #000;">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Tujuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td scope="row">{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->tujuan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- pagination --}}
        <div class="d-flex justify-content-end mt-4">
            {{ $data->links('vendor.pagination.mono') }}

        </div>
    </div>
@endsection
