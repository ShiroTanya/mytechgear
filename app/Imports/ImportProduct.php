<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
          return new Product([
           'product_name' => $row[0], 
           'product_tags' => $row[1],
           'product_quantity' => $row[2],
           'product_sold' => $row[3],
           'product_slug' => $row[4],
           'category_id' => $row[5],
           'brand_id' => $row[6],
           'product_desc' => $row[7],
           'product_content' => $row[8],
           'product_price' => $row[9],
           'price_cost' => $row[10],
           'product_image' => $row[11],
           'product_views' => $row[12],
           'product_status' => $row[13],
        ]);
    }
}
