<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true; //ova po default e false , i ako e taka ke bara logiran user 
   }

   /** 
    * Get the validation rules that apply to the request .
    *
    * @return array
    */
   public function rules()
   {
      return [
         'name' => 'required',
         'email' => 'required|email',
         'password' => 'required',
         // 'password_confirm'=> 'require|same:password',
         'username' => 'required',
      ];
   }
}
