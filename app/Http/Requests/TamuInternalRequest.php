<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TamuInternalRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'unit' => 'required|string|max:255',
            'unit_homebase' => 'nullable|string|max:255',
            'tanggal_internal' => 'required|date',
            'sifat_tujuan_kunjungan_internal' => 'required',
            'tujuan_internal' => 'required',
            'keperluan_internal' => 'required|string|max:1000',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama Lengkap',
            'nip' => 'NIP',
            'unit' => 'Unit',
            'unit_homebase' => 'Unit Homebase',
            'tanggal_internal' => 'Hari/Tanggal',
            'sifat_tujuan_kunjungan_internal' => 'Tujuan Kunjungan',
            'tujuan_internal' => 'Pihak yang Dituju',
            'keperluan_internal' => 'Keperluan',
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
