<?php

	namespace Tests\Feature;

	use App\DTO\ArticlesDTO;
	use App\Services\GuardianService;
	use Illuminate\Support\Facades\Http;
	use Tests\TestCase;

	class GuardianServiceTest extends TestCase
	{
		public function testSuccessfulApiCall()
		{
			Http::fake([
				'https://content.guardianapis.com/search*' => Http::response([
					'response' => [
						'results' => [
							[
								"webTitle" => "Strictly Come Dancing: Blackpool results – live",
								"webUrl" => "https://www.theguardian.com/tv-and-radio/live/2023/nov/18/strictly-come-dancing-blackpool-special-live",
								"sectionId" => "tv-and-radio",
								"webPublicationDate" => "2023-11-19T20:03:10Z",
								"apiUrl" => "https://content.guardianapis.com/tv-and-radio/live/2023/nov/18/strictly-come-dancing-blackpool-special-live",
								"id" => "tv-and-radio/live/2023/nov/18/strictly-come-dancing-blackpool-special-live"
							]
						]
					]
				], 200)
			]);

			$service = new GuardianService();
			$articles = $service->update();

			$this->assertIsArray($articles);
			$this->assertCount(1, $articles);
			$this->assertInstanceOf(ArticlesDTO::class, $articles[0]);
		}
	}
