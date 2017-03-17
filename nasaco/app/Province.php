<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'provinces';

    protected $fillable = [
        'id',
        'code',
        'name',
        'postal_code'];
}
