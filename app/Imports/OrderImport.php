<?php

namespace App\Imports;

use App\Orders;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class OrderImport implements ToModel, WithHeadingRow
{

    public function model(array $array)
    {
        $conditions = [
            'Order_Number' => $array['order_number'],
            'Item_Name' => $array['item_name']
        ];

        $data = [
            'Building_Name' => $array['building_name'],
            'Order_Status' => $array['order_status'],
            'Order_Date' => Date::excelToDateTimeObject($array['order_date'])->format('Y-m-d h:i:s'),
            'Customer_Note' => $array['customer_note'],
            'First_Name_Billing' => $array['first_name_billing'],
            'Last_Name_Billing' => $array['last_name_billing'],
            'Company_Billing' => $array['company_billing'],
            'House_No' => $array['house_no'],
            'Tower' => $array['tower'],
            'Address_1And2_Billing' => $array['address_12_billing'],
            'City_Billing' => $array['city_billing'],
            'State_Code_Billing' => $array['state_code_billing'],
            'Postcode_Billing' => $array['postcode_billing'],
            'Country_Code_Billing' => $array['country_code_billing'],
            'Email_Billing' => $array['email_billing'],
            'Phone_Billing' => $array['phone_billing'],
            'First_Name_Shipping' => $array['first_name_shipping'],
            'Last_Name_Shipping' => $array['last_name_shipping'],
            'Address_1And2_Shipping' => $array['address_12_shipping'],
            'City_Shipping' => $array['city_shipping'],
            'State_Code_Shipping' => $array['state_code_shipping'],
            'Postcode_Shipping' => $array['postcode_shipping'],
            'Country_Code_Shipping' => $array['country_code_shipping'],
            'Payment_Method_Title' => $array['payment_method_title'],
            'Cart_Discount_Amount' => $array['cart_discount_amount'],
            'Order_Subtotal_Amount' => $array['order_subtotal_amount'],
            'Shipping_Method_Title' => $array['shipping_method_title'],
            'Order_Shipping_Amount' => $array['order_shipping_amount'],
            'Order_Refund_Amount' => $array['order_refund_amount'],
            'Order_Total_Amount' => $array['order_total_amount'],
            'Order_Total_Tax_Amount' => $array['order_total_tax_amount'],
            'SKU' => $array['sku'],
            'Item_Sr_No' => $array['item'],
            'Quantity' => $array['quantity'],
            'Item_Cost' => $array['item_cost'],
            'Coupon_Code' => $array['coupon_code'],
            'Discount_Amount' => $array['discount_amount'],
            'Discount_Amount_Tax' => $array['discount_amount_tax'],
        ];
        Orders::updateOrCreate(
            $conditions,
            $data
        );
    }

    public function headingRow(): int
    {
        return 1;
    }

}
