<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('Building_Name');
            $table->string('Order_Number');
            $table->string('Order_Status');
            $table->string('Order_Date');
            $table->string('Customer_Note');
            $table->string('First_Name_Billing');
            $table->string('Last_Name_Billing');
            $table->string('Company_Billing');
            $table->string('House_No');
            $table->string('Tower');
            $table->string('Address_1And2_Billing');
            $table->string('City_Billing');
            $table->string('State_Code_Billing');
            $table->string('Postcode_Billing');
            $table->string('Country_Code_Billing');
            $table->string('Email_Billing');
            $table->string('Phone_Billing');
            $table->string('First_Name_Shipping');
            $table->string('Last_Name_Shipping');
            $table->string('Address_1And2_Shipping');
            $table->string('City_Shipping');
            $table->string('State_Code_Shipping');
            $table->string('Postcode_Shipping');
            $table->string('Country_Code_Shipping');
            $table->string('Payment_Method_Title');
            $table->string('Cart_Discount_Amount');
            $table->string('Order_Subtotal_Amount');
            $table->string('Shipping_Method_Title');
            $table->string('Order_Shipping_Amount');
            $table->string('Order_Refund_Amount');
            $table->string('Order_Total_Amount');
            $table->string('Order_Total_Tax_Amount');
            $table->string('SKU');
            $table->string('Item_Sr_No');
            $table->string('Item_Name');
            $table->string('Quantity');
            $table->string('Item_Cost');
            $table->string('Coupon_Code');
            $table->string('Discount_Amount');
            $table->string('Discount_Amount_Tax');
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
