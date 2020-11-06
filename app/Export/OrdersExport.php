<?php

namespace App\Export;

use App\Orders;
use Maatwebsite\Excel\Concerns\FromArray;

class OrdersExport implements FromArray
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array():array
    {
        return $this->data;
    }


}

?>