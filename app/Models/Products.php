<?php

namespace App\Models;

use App\Models\Transactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function transactions(){
        return $this->belongsTo(Transactions::class);
    }
}
