<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class employeePayment extends Model
{
    use HasFactory;
    use SoftDeletes;  
    protected $guarded = [];
    protected $casts = [
        'changed_data' => 'array',
    ];
 



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->changed_data)) {

                $model->changed_data = [
                    'status'=>false,
                    'data'=>[],
                ];
            }
          
        });
    }

    public function employees(){
        return $this->belongsTo('App\Models\employee','employee_id','id')->withTrashed();
    }
    
    public function paymentType(){
        return $this->belongsTo('App\Models\employeePaymentType','employee_payment_type_id','id')->withTrashed();
    }
    

    public function salaryStatus(){
        return $this->belongsTo('App\Models\salaryStatus','salary_status_id','id')->withTrashed();
    }
    

    public function abasas(){
        $this->employee = $this->employees->name;
        $this->payment_type = $this->paymentType->name;
        $this->salary_status = $this->salaryStatus->name;
        $this->month_formated = Carbon::parse($this->month)->format('F, Y');
    }  



}
