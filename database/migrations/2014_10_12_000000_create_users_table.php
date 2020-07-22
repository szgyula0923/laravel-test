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
        Schema::create('users', function ($collection) {
            $collection->string('first_name');
            $collection->string('last_name');
            $collection->string('phone');
            $collection->string('fb_link');
            $collection->string('password');
            $collection->unique('email');
            $collection->string('birth_date');
            $collection->boolean('active');
            $collection->boolean('admin');
            $collection->timestamp('email_verified_at')->nullable();
            $collection->rememberToken();
            $collection->timestamps();
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
