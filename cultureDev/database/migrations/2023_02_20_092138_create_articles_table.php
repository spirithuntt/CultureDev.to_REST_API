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
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title', 30)->nullable(false);
                $table->date('date_published')->nullable(false);
                $table->text('description')->nullable(false);
                $table->unsignedBigInteger('category_id')->nullable(false);
                $table->unsignedBigInteger('author_id')->nullable(false);
                $table->unsignedBigInteger('user_id')->nullable(false);
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade');
                $table->foreign('author_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('articles');
        }

};
