<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Programme extends Model
{
    use HasFactory, Sortable;

    protected $table = 'programme';

    public $timestamps = false;

    public $sortable = ['type', 'code', 'title'];
}
