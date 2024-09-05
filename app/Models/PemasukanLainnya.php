<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanLainnya extends Model
{
    use HasFactory;
    protected $table = 'pemasukkan_lainnyas';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    const TUNAI = 'tunai';
}
