<?php

	namespace App\Console\Commands;

	use App\DTO\ArticlesDTO;
	use App\Enums\ArticleCategoriesEnum;
	use App\Models\Article;
	use Illuminate\Console\Command;

	class UpdateNews extends Command
	{
		/**
		 * The name and signature of the console command.
		 *
		 * @var string
		 */
		protected $signature = 'update:news';

		/**
		 * The console command description.
		 *
		 * @var string
		 */
		protected $description = 'Command description';

		/**
		 * Execute the console command.
		 */
		public function handle()
		{
			$newsUpdaters = app()->tagged('news_updaters');

			foreach ($newsUpdaters as $newsUpdater) {
				$this->newLine();
				$this->info('Updating ' . get_class($newsUpdater) . '...');
				$articles = $newsUpdater->update();
				$this->saveArticles($articles);
			}
		}

		private function saveArticles($articles)
		{
			/**
			 * @var Article $article
			 * @var ArticlesDTO $articleDto
			 * @var ArticleCategoriesEnum $articleDto ->category
			 */
			foreach ($articles as $articleDto) {
				$article = Article::firstOrCreate(
					['uniqueId' => $articleDto->uniqueId],
					[
						'uniqueId' => $articleDto->uniqueId,
						'title' => $articleDto->title,
						'content' => $articleDto->content,
						'description' => $articleDto->description,
						'url' => $articleDto->url,
						'image' => $articleDto->image,
						'sourceName' => $articleDto->sourceName,
						'sourceId' => $articleDto->sourceId,
						'author' => $articleDto->author,
						'category' => $articleDto->category->value(),
						'publishedAt' => \Date::parse($articleDto->publishedAt)->format('Y-m-d H:i:s'),
					]
				);
				if ($article->wasRecentlyCreated) {
					$this->info('Created ' . $article->uniqueId);
				} else {
					$this->line('Duplicate article ' . $article->uniqueId);
				}
			}
		}
	}
