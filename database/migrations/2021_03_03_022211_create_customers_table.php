<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('priority');

            // create foreign key to assistants table
            $table->unsignedBigInteger('assistant_id')->nullable();
            $table->foreign('assistant_id')->references('id')->on('assistants');

            // $table->foreignId('assistant_id')->nullable()->constrained();
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
        Schema::dropIfExists('customers');
    }
}
