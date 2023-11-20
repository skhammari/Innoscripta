<?php

	namespace App\Services;

	use App\DTO\ArticlesDTO;
	use App\Enums\ArticleCategoriesEnum;

	class NYTimesService implements NewsUpdaterInterface
	{

		const URL = 'https://api.nytimes.com/svc/news/v3/content/all/all.json';
		public function sendRequest($url, ?array $params)
		{
			$apikey = getenv('NY_TIMES_API_KEY');
			$baseUrl = self::URL . "?api-key=" . $apikey;
			$response = \Http::get($baseUrl);

			return $response;
		}

		public function update()
		{
			$response = $this->sendRequest(self::URL, []);
			$articles = $response->json()['results'];
			$news = [];
			foreach ($articles as $article) {
				try {
					$category = ArticleCategoriesEnum::from($article['section']);
				} catch (\ValueError $e) {
					$category = ArticleCategoriesEnum::GENERAL;
				}

				$news[] = new ArticlesDTO(
					$article['title'],
					$article['abstract'],
					$article['abstract'],
					$article['url'],
					$article['multimedia'][0]['url']??'',
					$article['source'],
					$article['source'],
					$article['byline'],
					$article['published_date'],
					$category
				);
			}

			return $news;
		}
	}