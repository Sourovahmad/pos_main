<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperInfo extends Model
{
    use HasFactory;
    
    protected $table = 'developer_info';
    
    protected $fillable = [
        'company_name',
        'demo_owner_account',
        'address',
        'license_key',
        'demo_valid_till',
        'monthly_price',
        'one_time_price',
    ];
    
    protected $casts = [
        'demo_valid_till' => 'date',
    ];
}
