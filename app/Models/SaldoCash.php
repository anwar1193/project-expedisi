<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoCash extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    const STATUS_PENDING = 0;
    const STATUS_APPROVE = 1;
}
