<?php

	namespace Tests\Unit;

	use App\DTO\ArticlesDTO;
	use App\Enums\ArticleCategoriesEnum;
	use PHPUnit\Framework\TestCase;

	class ArticleDTOTest extends TestCase
	{
		public function testConstructorAndToArray()
		{
			$dto = new ArticlesDTO(
				'Sample Title',
				'Sample Content',
				'Sample Description',
				'https://example.com',
				'https://example.com/image.jpg',
				'Example Source',
				'source-id-123',
				'Author Name',
				'2023-01-01 10:00:00',
				ArticleCategoriesEnum::GENERAL
			);

			$this->assertEquals('Sample Title', $dto->title);
			$this->assertEquals('Sample Content', $dto->content);
			$this->assertEquals(ArticleCategoriesEnum::GENERAL, $dto->category);

			$arrayRepresentation = $dto->toArray();
			$this->assertIsArray($arrayRepresentation);
			$this->assertEquals('Sample Title', $arrayRepresentation['title']);
		}

		public function testUniqueIdGeneration()
		{
			$dto = new ArticlesDTO(
				'Sample Title',
				'Sample Content',
				'Sample Description',
				'https://example.com',
				'https://example.com/image.jpg',
				'Example Source',
				'source-id-123',
				'Author Name',
				'2023-01-01 10:00:00',
				ArticleCategoriesEnum::GENERAL
			);

			$this->assertIsString($dto->uniqueId);
			$this->assertEquals('Example Source-SampleTitle-2023-01-01 10:00:00', $dto->uniqueId);
		}
	}
