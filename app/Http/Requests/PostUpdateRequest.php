<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = \Request::segment(2);
		return [
			'titre' => 'required|max:255',
			'sommaire' => 'required|max:65000',
			'contenu' => 'required|max:65000',
			'slug' => 'required|unique:posts,slug,' . $id,
			'tags' => ['regex:/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/']  // voir si ? vraiment utile
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return ['tags.regex' => 'Les mots-clefs, séparés par des virgules (sans espaces), doivent avoir au maximum 50 caractères alphanumériques'];
	}
 
}
