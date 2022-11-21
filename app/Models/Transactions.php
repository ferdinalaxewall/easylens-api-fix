<?php

namespace App\Models;

use App\Models\Accounts;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(){
        return $this->hasMany(Products::class, 'id');
    }
}
