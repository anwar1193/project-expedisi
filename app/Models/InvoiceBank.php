<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBank extends Model
{
    use HasFactory;
    protected $table = 'invoice_banks';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
