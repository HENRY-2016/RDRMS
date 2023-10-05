<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivesModel extends Model
{
    use HasFactory;
    protected $table = 'dives_table';
    protected $guarded = array();
}
