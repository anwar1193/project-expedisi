<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pesans';

    public const INV = 1;
    public const SP = 2;
}
