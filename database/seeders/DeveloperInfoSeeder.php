<?php

namespace Database\Seeders;

use App\Models\DeveloperInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeveloperInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developerInfo = DeveloperInfo::find(1);
        
        // Generate demo valid till date (1 month from today)
        $demoValidTill = Carbon::now()->addMonth();
        
        if ($developerInfo) {
            // Record exists - preserve the existing license key, only update other fields
            $developerInfo->update([
                'company_name' => 'OrbiTax Corporation Limited',
                'demo_owner_account' => 'Sourov Ahmad',
                'address' => 'Via Carlo della rocca 36',
                'demo_valid_till' => $demoValidTill,
                'monthly_price' => 39.00,
                'one_time_price' => 399.00,
                // license_key is not updated - it remains unchanged
            ]);
        } else {
            // Record doesn't exist - generate a new license key
            $licenseKey = Str::random(32);
            
            DeveloperInfo::create([
                'id' => 1,
                'company_name' => 'OrbiTax Corporation Limited',
                'demo_owner_account' => 'Sourov Ahmad',
                'address' => 'Via Carlo della rocca 36',
                'license_key' => $licenseKey,
                'demo_valid_till' => $demoValidTill,
                'monthly_price' => 39.00,
                'one_time_price' => 399.00,
            ]);
        }
    }
}
