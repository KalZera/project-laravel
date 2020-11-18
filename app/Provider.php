<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cnpj',
        'main_activity',
        'register_in',
        'user_id',
    ];
}