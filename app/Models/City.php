<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";
    protected $fillable = ['name']; // Assuming that 'name' is a column in your 'cities' table

    public function addresses(){
        return $this->hasMany(UserAddress::class,'cities_id');
    }
}