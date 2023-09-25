<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class warrenty extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    protected $fillable = ["name","total_days"];


    public function abasas(){
        //
    }   

}
