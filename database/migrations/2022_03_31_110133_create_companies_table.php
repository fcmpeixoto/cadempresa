<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();;
            $table->string('name');
            $table->string('address',255);
            $table->string('website',255);
            $table->string('email')->unique();
            $table->string('logotipo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
        });


        Schema::table('users', function (Blueprint $table) {
            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
