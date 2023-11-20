<?php

	namespace App\DTO;

	use App\Enums\ArticleCategoriesEnum;
	use Str;

	class ArticlesDTO
	{
		public ?string $title;
		public ?string $content;
		public ?string $description;
		public ?string $url;
		public ?string $image;
		public ?string $sourceName;
		public string $sourceId;
		public ?string $author;
		public \DateTime $publishedAt;
		public ?ArticleCategoriesEnum $category;
		public string $uniqueId;

		public function __construct(
			?string $title,
			?string $content,
			?string $description,
			?string $url,
			?string $image,
			?string $sourceName,
			string $sourceId,
			?string $author,
			?string $publishedAt,
			?ArticleCategoriesEnum $category = ArticleCategoriesEnum::GENERAL,
		) {
			$this->title = $title;
			$this->content = $content;
			$this->description = $description;
			$this->url = $url;
			$this->image = $image;
			$this->sourceName = $sourceName;
			$this->sourceId = $sourceId;
			$this->author = $author;
			$this->publishedAt = new \DateTime($publishedAt);
			$this->category = $category;
			$this->uniqueId = $this->generateUniqueId();
		}

		public function toArray(): array
		{
			return [
				'title'       => $this->title,
				'content'     => $this->content,
				'description' => $this->description,
				'url'         => $this->url,
				'image'       => $this->image,
				'sourceName'  => $this->sourceName,
				'sourceId'    => $this->sourceId,
				'author'      => $this->author,
				'category'    => $this->category,
				'publishedAt' => $this->publishedAt,
				'uniqueId'    => $this->uniqueId,
			];
		}

		private function generateUniqueId(): string
		{
			$title = Str::replace(' ', '', Str::limit($this->title, 50, ''));
			return $this->sourceName . '-' . $title . '-' . $this->publishedAt->format('Y-m-d H:i:s');
		}
	}