<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LMCategory extends Model
{
    use HasFactory;

    protected $table = 'lm_category';

    public $timestamps = false;
}
