<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $fillable = ['user_id', 'description', 'calories', 'day', 'part_of_day'];

    

}
