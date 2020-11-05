<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'Building_Name', 'Order_Number', 'Order_Status', 'Order_Date', 'Customer_Note', 'First_Name_Billing', 'Last_Name_Billing', 'Company_Billing', 'House_No', 'Tower', 'Address_1And2_Billing', 'City_Billing', 'State_Code_Billing', 'Postcode_Billing', 'Country_Code_Billing', 'Email_Billing', 'Phone_Billing', 'First_Name_Shipping', 'Last_Name_Shipping', 'Address_1And2_Shipping', 'City_Shipping', 'State_Code_Shipping', 'Postcode_Shipping', 'Country_Code_Shipping', 'Payment_Method_Title', 'Cart_Discount_Amount', 'Order_Subtotal_Amount', 'Shipping_Method_Title', 'Order_Shipping_Amount', 'Order_Refund_Amount', 'Order_Total_Amount', 'Order_Total_Tax_Amount', 'SKU', 'Item_Sr_No', 'Item_Name', 'Quantity', 'Item_Cost', 'Coupon_Code', 'Discount_Amount', 'Discount_Amount_Tax'
    ];
}
