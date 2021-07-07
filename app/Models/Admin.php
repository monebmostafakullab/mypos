<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    protected $fillable = [
        'first_name','last_name', 'email', 'password','image','mobile'
    ];

    protected $appends = ['image_path'];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }
    
    public function getlastNameAttribute($value){
        return ucfirst($value);
    }

    public function getImagePathAttribute(){
        return asset('uploads/admin_images/' . $this->image);
    }

}
