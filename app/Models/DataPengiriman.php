<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengiriman extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    const STATUS_LUNAS = 1;
    const STATUS_PENDING = 2;
    const STATUS_APPROVE = 3;
}
