<?php

	namespace App\Services;

	use App\DTO\ArticlesDTO;
	use App\Enums\ArticleCategoriesEnum;

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
				try {
					$category = ArticleCategoriesEnum::from($article['sectionId']);
				} catch (\ValueError $e) {
					$category = ArticleCategoriesEnum::GENERAL;
				}

				$news[] = new ArticlesDTO(
					$article['webTitle'],
					'',
					'',
					$article['webUrl'],
					'',
					'Guardian',
					$article['id'],
					'',
					$article['webPublicationDate'],
					$category
				);
			}

			return $news;
		}
	}