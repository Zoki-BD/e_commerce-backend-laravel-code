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
            $table->string('name',70)->nullable();
            $table->string('surname',70)->nullable();
            $table->string('address',70)->nullable();
            $table->string('phone',70)->nullable();
            $table->string('photo',70)->nullable();
            $table->string('email',70)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username',70)->nullable();
            $table->string('password',70);
            $table->string('reset_password_hash',70)->nullable();
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
