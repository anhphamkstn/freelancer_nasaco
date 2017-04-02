<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'provinces';

    protected $fillable = [
        'code',
        'name',
        'postal_code'];
}
