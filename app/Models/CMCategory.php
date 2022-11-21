<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMCategory extends Model
{
    use HasFactory;

    protected $table = 'cm_category';

    public $timestamps = false;
}
