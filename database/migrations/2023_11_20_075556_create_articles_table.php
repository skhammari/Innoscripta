<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	return new class extends Migration {
		/**
		 * Run the migrations.
		 */
		public function up(): void
		{
			Schema::create('articles', function (Blueprint $table) {
				$table->id();
				$table->string('uniqueId')->unique();
				$table->string('title');
				$table->string('content');
				$table->string('description');
				$table->string('url');
				$table->string('image');
				$table->string('sourceName');
				$table->string('sourceId');
				$table->string('author');
				$table->string('category');
				$table->string('publishedAt');
				$table->timestamps();
			});
		}

		/**
		 * Reverse the migrations.
		 */
		public function down(): void
		{
			Schema::dropIfExists('articles');
		}
	};
