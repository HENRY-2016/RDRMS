<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorsModel extends Model
{
    use HasFactory;
    protected $table = 'instructors_table';
    protected $guarded = array();
}
