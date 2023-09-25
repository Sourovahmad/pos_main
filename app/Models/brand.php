<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brand extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $guarded = [];


    protected $fillable = ['name','description'];

    
    public function products(){
        return $this->hasMany('App\Models\Product');
    }


    public function abasas(){
        $this->products_count = $this->products->count();
    }   
}
