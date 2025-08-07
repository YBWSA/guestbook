<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TamuEksternalRequest extends FormRequest
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
            'nama_eksternal' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
            'instansi' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'tanggal_eksternal' => 'required|date',
            'sifat_tujuan_kunjungan_eksternal' => 'required',
            'tujuan_eksternal' => 'required',
            'keperluan_eksternal' => 'required|string|max:1000',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama Lengkap',
            'no_hp' => 'NIP',
            'instansi' => 'Unit',
            'alamat' => 'Unit Homebase',
            'tanggal_eksternal' => 'Hari/Tanggal',
            'sifat_tujuan_kunjungan_eksternal' => 'Tujuan Kunjungan',
            'tujuan_eksternal' => 'Pihak yang Dituju',
            'keperluan_eksternal' => 'Keperluan',
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
