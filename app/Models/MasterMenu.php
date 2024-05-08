<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMenu extends Model
{
    use HasFactory;
    protected $table = 'master_menus';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
