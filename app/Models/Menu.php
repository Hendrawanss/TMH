<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'harga'];

    protected $hidden = ['created_at', 'updated_at'];

    public function detail_transactions(){
        return $this->hasMany(DetailTransaction::class);
    }
}
