<?php

namespace App\Imports;

use App\Models\Order;
use App\Models\OrderProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrdersImport implements  ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $orderId;

    public function __construct($orderID)
    {
          $this->orderId = $orderID;
    }
    public function model(array $row)
    {
        
        return new OrderProduct([
            'order_id' => $this->orderId,
            'product_code'     => $row['code'],
            'description'    => $row['description'],
            'quantity'    => $row['quantity'],
            
        ]);
    }
}
