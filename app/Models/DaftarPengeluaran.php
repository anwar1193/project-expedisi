<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPengeluaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    const STATUS_APPROVE = 1;
    const STATUS_PENDING = 2;
    const TUNAI = 'tunai';
}
