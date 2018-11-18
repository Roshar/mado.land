<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //указваем таблицу с которой будет работать данная модель
    protected $table = 'peoples';
}
