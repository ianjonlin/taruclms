<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Course extends Model
{
    use HasFactory, Sortable;

    protected $table = 'course';

    public function isCC()
    {
        return hash_equals($this->cc_id, auth()->user()->user_id);
    }

    public $timestamps = false;

    public $sortable = ['code', 'title'];
}
