<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_type_id', 'name', 'address','contact'];

    protected $hidden = ['created_at', 'updated_at'];

    public function customer_type(){
        return $this->belongsTo(CustomerType::class,'customer_type_id','id');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
