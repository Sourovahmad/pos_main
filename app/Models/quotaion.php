<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotaion extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
    public function supplier(){
        return $this->belongsTo('App\Models\supplier','supplier_id','id')->withTrashed();
    }

    public function purchaseDetails(){
        return $this->hasMany(purchaseDetail::class, 'purchase_id','id');
    }
    
    public function abasas(){
        $this->supplier = $this->supplier->name;
        $this->time = $this->created_at->format('d M,Y h:i:a');
    } 
}
