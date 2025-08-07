<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TamuMhsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nim' => 'required|string|max:50',
            'namaMhs' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_mhs' => 'required|date',

            'tujuan_mhs' => 'required',
            'keperluan_mhs' => 'required|string|max:1000',
        ];
    }

    public function attributes(): array
    {
        return [
            'namaMhs' => 'Nama Lengkap',
            'nim' => 'NIM',
            'fakultas' => 'Fakultas',
            'jurusan' => 'Jurusan',
            'tanggal_mhs' => 'Hari/Tanggal',
            'tujuan_mhs' => 'Pihak yang Dituju',
            'keperluan_mhs' => 'Keperluan',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'in' => ':attribute tidak valid.',
            'max' => ':attribute terlalu panjang.',
            'date' => ':attribute harus berupa tanggal.',
        ];
    }
}
