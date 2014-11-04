<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('category_id');
			// $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->string('title');
			$table->string('slug');
			$table->longText('description');
			$table->text('content');
			$table->longText('meta_title');
			$table->longText('meta_keywords');
			$table->longText('meta_description');
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
		Schema::drop('posts');
	}

}
