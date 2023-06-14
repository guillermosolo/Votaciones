<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('tipo');
            $table->string('mesa')->nullable();
            $table->unsignedInteger('papeletas')->nullable();
            $table->boolean('mesaCerrada')->default(false);
            $table->boolean('mesaValidadaPres')->default(false);
            $table->boolean('mesaValidadaDip')->default(false);
            $table->boolean('mesaValidadaAl')->default(false);
            $table->boolean('mesaImpugnada')->default(false);
            $table->boolean('activo')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
