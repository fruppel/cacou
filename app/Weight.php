<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = ['user_id', 'weight', 'created_at'];

}
