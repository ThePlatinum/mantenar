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
    Schema::create('shares', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('file');
      $table->string('type');
      $table->string('size');
      $table->string('slug');
      $table->foreignIdFor(App\Models\User::class, 'author_user_id')->constrained('users');
      $table->string('note')->nullable();
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
    Schema::dropIfExists('shares');
  }
};
