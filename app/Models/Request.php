<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',
    'title',
    'descryption',
    'priority',
    'supervisor_verify',
    'admin_verify'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function appends(){
        return $this->hasMany(Appends::class);
    }
}
