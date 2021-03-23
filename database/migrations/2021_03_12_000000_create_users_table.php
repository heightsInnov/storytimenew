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
            $table->increments('id');
            $table->unsignedInteger('story_seeker_id')->nullable();
            $table->unsignedInteger('story_teller_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('location')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('writing_preference')->nullable();
            $table->string('code');
            $table->boolean('changed_password')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->boolean('disabled')->default(false);
            $table->boolean('is_activated')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_story_seeker')->default(false);
            $table->boolean('is_story_teller')->default(false);
            $table->foreign('story_seeker_id')->references('id')->on('story_seekers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreign('story_teller_id')->references('id')->on('story_tellers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
