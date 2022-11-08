<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Keyword extends Model
{
    use HasFactory, Sortable;

    protected $table = 'blocked_keywords';

    public $timestamps = false;

    public $sortable = ['value', 'added_by', 'added_at'];
}
