<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmtBoard extends Model
{
    use HasFactory;

    protected $table = 'cmt_boards';
    protected $fillable = ['boardsid','comment','userid'];
}
