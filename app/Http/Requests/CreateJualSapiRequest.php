<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJualSapiRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'nama_pembeli' => 'required',
            'no_tlpn' => 'required',
            'status_bayar' => 'required',
            'bayar' => 'required',
            'id_chart' => 'required',
            'alamat' => 'required',

		];
	}
}
