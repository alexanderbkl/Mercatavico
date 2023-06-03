<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = "user_addresses";
    protected $fillable = ['address','city','cp','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}