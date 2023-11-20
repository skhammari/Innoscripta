<?php

	namespace Tests\Feature;

	use App\Models\Article;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Tests\TestCase;

	class ArticleSearchTest extends TestCase
	{
		use RefreshDatabase;

		protected function setUp(): void
		{
			parent::setUp();
			Article::factory()->create(
				[
					'uniqueId'    => '12345',
					'sourceName'  => 'New York Times',
					'sourceId'    => 'nyt',
					'title'       => 'First Article',
					'category'    => 'News',
					'publishedAt' => '2024-01-01 00:00:00',
					'author'      => 'John Doe',
					'content'     => 'This is the first article',
					'url'         => 'https://www.nytimes.com/2024/01/01/first-article',
					'image'       => 'https://www.nytimes.com/2024/01/01/first-article'
				]
			);
			Article::factory()->create(
				[
					'uniqueId'    => '67890',
					'sourceName'  => 'Guardian',
					'sourceId'    => 'guardian',
					'title'       => 'Second Article',
					'category'    => 'Tech',
					'publishedAt' => '2024-01-01 00:00:00',
					'author'      => 'Jane Doe',
					'content'     => 'This is the second article',
					'url'         => 'https://www.guardian.com/second-article',
					'image'       => 'https://www.guardian.com/second-article'
				]
			);
		}

		/**
		 * A basic feature test example.
		 */
		public function testBasicSearch(): void
		{
			// Given we have some articles

			// When we search for articles
			$response = $this->getJson('/api/articles/search?title=First');

			// Then we should get 1 article
			$response->assertOk();
			$response->assertJsonCount(1, 'data');
			$response->assertJsonPath('data.0.title', 'First Article');
		}

		public function testFilterByCategory(): void
		{
			// Given we have some articles

			// When we search for articles in the News category
			$response = $this->getJson('/api/articles/search?category=News');

			// Then we should get 1 article
			$response->assertOk();
			$response->assertJsonCount(1, 'data');
			$response->assertJsonPath('data.0.title', 'First Article');

			// Or when we search for articles in the General category
			$response = $this->getJson('/api/articles/search?category=General');

			// Then we should get 0 articles
			$response->assertOk();
			$response->assertJsonCount(0, 'data');
		}
	}
