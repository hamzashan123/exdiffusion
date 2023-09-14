<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $category_id = null;

        $category  = Category::where('name',$row['category'])->first();
        $subCategory  = Category::where('name',$row['subcategory'])->first();

        if($category == null){
           $category =  Category::create([
                'name' => $row['category']
            ]);
        }

        if($subCategory == null && $category->id != null){
            $subCategory =  Category::create([
                 'name' => $row['subcategory'],
                 'parent_id' => $category->id
             ]);
         }

        if($category != null){
            $category_id = $category->id;
        }else{
            $category_id = $subCategory->id;
        }

        // if (strpos($row['description'], "�") !== false) {
        //     dd($row['description']);
        // } 

        return new Product([
            'code'     => $row['code'],
            'name'    => $row['description'],
            'price'    => $row['price'], 
            'premium_price'    => $row['premiumprice'],
            'category_id'    => $category_id,
            'sub_category_id' => $subCategory->id,
            'product_import_url' => $row['imageurl'],
            'quantity' => 1,
            'status'    => true,
            'featured'    => true,
           
        ]);
    }
}
