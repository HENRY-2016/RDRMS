<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentsModel extends Model
{
    use HasFactory;
    protected $table = 'equipments_table';
    protected $guarded = array();
}
