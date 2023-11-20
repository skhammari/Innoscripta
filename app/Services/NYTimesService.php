<?php

	namespace App\Services;

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
				$news[] = [
					'title'       => $article['title'],
					'content'     => $article['abstract'],
					'description' => $article['abstract'],
					'url'         => $article['url'],
					'image'       => $article['multimedia'][0]['url']??'',
					'sourceName'  => $article['source'],
					'sourceId'    => $article['source'],
					'author'      => $article['byline'],
					'publishedAt' => $article['published_date'],
				];
			}

			return $news;
		}
	}