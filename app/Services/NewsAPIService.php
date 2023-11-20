<?php

	namespace App\Services;

	use App\DTO\ArticlesDTO;
	use App\Enums\ArticleCategoriesEnum;

	class NewsAPIService implements NewsUpdaterInterface
	{

		const URL = 'https://newsapi.org/v2/top-headlines';

		public function sendRequest($url, $params)
		{
			$headers = [
				'X-Api-Key' => getenv('NEWSAPI_ORG_KEY'),
			];
			$response = \Http::withHeaders($headers)->get($url, $params);

			return $response;
		}

		public function update(): array
		{
			// todo: we need to make request for all categories
			$params = [
				'country'  => 'de',
				'category' => ArticleCategoriesEnum::GENERAL->value,
			];
			$response = $this->sendRequest(self::URL, $params);
			$articles = $response->json()['articles'];
			$news = [];
			foreach ($articles as $article) {
				$news[] = new ArticlesDTO(
					$article['title'],
					$article['content'],
					$article['description'],
					$article['url'],
					$article['urlToImage'],
					$article['source']['name'],
					$article['source']['id'],
					$article['author'],
					$article['publishedAt'],
					ArticleCategoriesEnum::GENERAL,
				);
			}

			return $news;
		}
	}