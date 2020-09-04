<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIdentitasSapiRequest extends FormRequest {

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
            'id_sapi' => 'required', 
            'jenis_sapi' => 'required', 
            'bobot_awal' => 'required', 
            'harga' => 'required', 
            'tanggal_masuk' => 'required', 
            'belanjasapi_id' => 'required', 
            
		];
	}
}
