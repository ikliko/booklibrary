<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('cover_large', 255);
            $table->string('cover_normal', 255);
            $table->string('author');
            $table->integer('pages');
            $table->text('resume');
            $table->char('format', 2);
            $table->timestamp('publish');
            $table->string('isbn', 255);
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }
}
