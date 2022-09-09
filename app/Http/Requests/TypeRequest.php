<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'nama_jenis_pinjaman'       => 'required|min:3',
            'minimum_jumlah_pinjaman'   => 'required|integer',
            'maksimum_jumlah_pinjaman'  => 'required|integer|gt:minimum_jumlah_pinjaman',
            'minimum_lama_angsuran'     => 'required|integer',
            'maksimum_lama_angsuran'    => 'required|integer|gt:minimum_lama_angsuran',
            'bunga'                     => 'required|integer',
        ];
    }
}
