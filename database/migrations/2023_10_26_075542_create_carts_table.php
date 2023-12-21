<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Change to unsignedBigInteger for user_id
            $table->string('user_name');
            $table->unsignedBigInteger('concert_id');
            $table->string('concert_name');
            $table->string('seat_number'); // Change to string for seat_numbers
            $table->integer('seat_quantity');
            $table->decimal('total_price', 10, 2); // Example: 10 digits total, 2 digits after the decimal point
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
        Schema::dropIfExists('carts');
    }
};
