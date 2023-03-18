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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',100)->unique();
            $table->string('password',100);
            $table -> string('salt',40);
            $table -> string('gender',20);
            $table -> string('bio',150)->nullable();
            $table -> string('dob',100);
            $table -> string('location',100);
            $table -> string('picture1',100);
            $table -> string('picture2',100)->nullable();
            $table -> string('picture3',100)->nullable();
            $table -> string('picture4',100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
