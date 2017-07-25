<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedditsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reddits', function (Blueprint $table) {
			$table->increments('id');
			$table->string('reddit_id')->nullable();
			$table->string('subreddit')->nullable();
			$table->string('title')->nullable();
			$table->string('selftext')->nullable();
			$table->string('image_url')->nullable();
			$table->string('nsfw')->nullable();
			$table->string('ups')->nullable();
			$table->string('permalink')->nullable();
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
		Schema::dropIfExists('reddits');
	}
}
