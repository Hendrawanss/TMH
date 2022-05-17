<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'menu_id', 'total_item'];

    protected $hidden = ['created_at', 'updated_at'];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
