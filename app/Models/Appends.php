<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appends extends Model
{
    use HasFactory;

    protected $fillable = ['id','request_id','path'];
}
