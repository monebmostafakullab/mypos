<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Model
{
    use LaratrustUserTrait;
    protected $fillable = [
        'first_name','last_name', 'email', 'password','mobile'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
