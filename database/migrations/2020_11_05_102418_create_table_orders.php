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
            $table->string('Building_Name')->nullable();
            $table->string('Order_Number')->nullable();
            $table->string('Order_Status')->nullable();
            $table->dateTime('Order_Date')->nullable();
            $table->string('Customer_Note')->nullable();
            $table->string('First_Name_Billing')->nullable();
            $table->string('Last_Name_Billing')->nullable();
            $table->string('Company_Billing')->nullable();
            $table->string('House_No')->nullable();
            $table->string('Tower')->nullable();
            $table->string('Address_1And2_Billing')->nullable();
            $table->string('City_Billing')->nullable();
            $table->string('State_Code_Billing')->nullable();
            $table->string('Postcode_Billing')->nullable();
            $table->string('Country_Code_Billing')->nullable();
            $table->string('Email_Billing')->nullable();
            $table->string('Phone_Billing')->nullable();
            $table->string('First_Name_Shipping')->nullable();
            $table->string('Last_Name_Shipping')->nullable();
            $table->string('Address_1And2_Shipping')->nullable();
            $table->string('City_Shipping')->nullable();
            $table->string('State_Code_Shipping')->nullable();
            $table->string('Postcode_Shipping')->nullable();
            $table->string('Country_Code_Shipping')->nullable();
            $table->string('Payment_Method_Title')->nullable();
            $table->string('Cart_Discount_Amount')->nullable();
            $table->string('Order_Subtotal_Amount')->nullable();
            $table->string('Shipping_Method_Title')->nullable();
            $table->string('Order_Shipping_Amount')->nullable();
            $table->string('Order_Refund_Amount')->nullable();
            $table->string('Order_Total_Amount')->nullable();
            $table->string('Order_Total_Tax_Amount')->nullable();
            $table->string('SKU')->nullable();
            $table->string('Item_Sr_No')->nullable();
            $table->string('Item_Name')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('Item_Cost')->nullable();
            $table->string('Coupon_Code')->nullable();
            $table->string('Discount_Amount')->nullable();
            $table->string('Discount_Amount_Tax')->nullable();
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
