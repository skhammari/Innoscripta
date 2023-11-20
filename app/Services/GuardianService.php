<?php

	namespace App\Services;

	class GuardianService implements NewsUpdaterInterface
	{

		const URL = 'https://content.guardianapis.com/search';
		public function sendRequest($url, ?array $params)
		{
			$apikey = getenv('GUARDIAN_API_KEY');
			$params = array_merge($params, [
				'api-key' => $apikey
			]);
			$response = \Http::get($url, $params);

			return $response;
		}

		public function update()
		{
			$response = $this->sendRequest(self::URL, []);
			$articles = $response->json()['response']['results'];
			$news = [];
			foreach ($articles as $article) {
				$news[] = [
					'title'       => $article['webTitle'],
					'url'         => $article['webUrl'],
					'sourceName'  => 'The Guardian',
					'sourceId'    => $article['id'],
					'author'      => '',
					'category'    => $article['sectionName'],
					'publishedAt' => $article['webPublicationDate'],
				];
			}

			return $news;
		}
	}