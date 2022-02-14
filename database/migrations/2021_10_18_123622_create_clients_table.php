<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('account_number');
            $table->string('id_number');
            $table->bigInteger('tax_number');
            $table->integer('zip_code');
            $table->string('email')->unique();
            $table->biginteger('phone_number')->nullable();
            $table->foreignId('created_by')->nullable()->references('id')->on('users');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users');   
            $table->foreignId('deleted_by')->nullable()->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
