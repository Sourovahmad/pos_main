<?php

namespace App\Imports;

use App\Models\brand;
use App\Models\category;
use App\Models\Product;
use App\Models\warrenty;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importProducts implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

   
        $category = category::where("name", $row["category"])->first();
        if(!$category){
         $category = category::create([
                "name" => $row["category"]
            ]);
        }


        $brand = brand::where("name", $row["brand"])->first();
        if(!$brand){
         $brand = brand::create([
                "name" => $row["category"]
            ]);
        }


        $taxType = 0;
        if($row["tax_type"] == "excluded"){
            $taxType = 1;
        }else{
            $taxType = 2;
        }


        $warrenty = warrenty::where("name", $row["warrenty"])->first();
        $warrentyDayInTotal = 0;
        if(!$warrenty){

            $rowWarrentyString = $row["warrenty"];
            if (Str::contains($rowWarrentyString, 'year')) {
                $parts = explode(' ', $rowWarrentyString);
                $numberinYear = (int)$parts[0]; // $number will be '1'
                $warrentyDayInTotal = $numberinYear * 365;


            }else if (Str::contains($rowWarrentyString, 'months')){

                $parts = explode(' ', $rowWarrentyString);
                $numberinMonth = (int)$parts[0]; // $number will be '1'

                $warrentyDayInTotal = $numberinMonth * 30;

            }


            $warrenty = warrenty::create([
                "name" => $rowWarrentyString,
                "total_days" => $warrentyDayInTotal
            ]);
            
        }

        $isFiexedPriceBool = 0;
        if($row["is_fixed_price"] == "yes"){
            $isFiexedPriceBool = 1;
        }


        return new Product([
            "name" => $row["name"],
            "category_id" => $category->id,
            "brand_id" => $brand->id,
            "type_id" => 1,
            "unit_id" => 1,
            "tax_type_id" => $taxType,
            "warrenty_id" => $warrenty->id,
            "cost_per_unit" => $row["cost_per_unit"],
            "price_per_unit" => $row["sell_price"],
            "is_fixed_price" => $isFiexedPriceBool,
            "stock" => $row["stock"],
            "stock_alert" => $row["stock_alert"],
            "description" => $row["description"]
        ]);
    }
}
