<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
       
            $table->string('quantity');
            $table->float('price');

            $table->string('added_by');
            $table->enum('order_kind',['sale','takeaway','delevery'])->default('sale');
            $table->enum('condition',['pending','processing','delivered','cancelled'])->default('pending'); //في الانتطار pending

            $table->string('cancele_reason')->nullable();
            $table->integer('canceled_by')->nullable();

            $table->string('payment_method');
            $table->float('tax_fees');
            $table->float('service_fees');
            $table->float('discount');
            $table->float('total_price');

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->unsignedBigInteger('delevry_id');
            $table->foreign('delevry_id')->references('id')->on('delivery_boys')->onDelete('cascade')->nullable();

            $table->unsignedBigInteger('addons_id');
            $table->foreign('addons_id')->references('id')->on('addons')->onDelete('cascade');


            $table->unsignedBigInteger('table_id');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');


            
            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');


            $table->unsignedBigInteger('shift_id');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');


            $table->timestamps();
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
