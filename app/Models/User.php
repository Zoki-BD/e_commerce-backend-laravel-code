<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;

   //protected $guarded = []; //all can be changed


   //These can only be changed
   protected $fillable = [
      'name',
      'surname',
      'username',
      'address',
      'phone',
      'photo',
      'email',
      'email_verified_at',
      'password',
      'reset_password_hash',
      'remember_token'
   ];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array
    */
   protected $hidden = [
      'password'

   ];


   //  protected $casts = [
   //      'email_verified_at' => 'datetime',
   //  ];
}
