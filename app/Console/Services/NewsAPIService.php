<?php

	namespace App\Console\Services;

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
			$params = [
				'country' => 'de',
			];
			$response = $this->sendRequest(self::URL, $params);
			$articles = $response->json()['articles'];
			$news = [];
			foreach ($articles as $article) {
				$news[] = [
					'title'       => $article['title'],
					'content'     => $article['content'],
					'description' => $article['description'],
					'url'         => $article['url'],
					'image'       => $article['urlToImage'],
					'sourceName'  => $article['source']['name'],
					'sourceId'    => $article['source']['id'],
					'author'      => $article['author'],
					'publishedAt' => $article['publishedAt'],
				];
			}

			return $news;
		}
	}