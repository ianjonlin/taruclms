<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Course extends Model
{
    use HasFactory, Sortable;

    protected $table = 'course';

    public $timestamps = false;

    public $sortable = ['code', 'title'];
}
