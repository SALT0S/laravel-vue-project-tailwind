<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the persons table
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->timestamps();
        });

        // Create the orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->dateTime('date_to_complete');
            $table->enum('status', ['in progress', 'completed']);
            $table->string('comments')->nullable();
            $table->unsignedBigInteger('person_id');
            $table->timestamps();

            // Add foreign key constraint to link orders to persons
            $table->foreign('person_id')
                ->references('id')->on('persons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the orders table
        Schema::dropIfExists('orders');


        // Drop the persons table
        Schema::dropIfExists('persons');
    }
};
