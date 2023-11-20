<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\ArticleSearchRequest;
	use App\Http\Resources\ArticleCollection;
	use App\Models\Article;
	use Illuminate\Http\Request;

	class ArticleController extends Controller
	{

		public function index()
		{
			$allArticles = Article::all();
			return new ArticleCollection($allArticles);
		}

		public function search(ArticleSearchRequest $request)
		{
			$articleQuery = Article::query();

			// search by title
			if ($request->has('title')) {
				$articleQuery->where('title', 'like', '%' . $request->title . '%');
			}

			// filter by date
			if ($request->has('begin_date') && $request->has('end_date')) {
				$articleQuery->whereBetween('publishedAt', [$request->begin_date, $request->end_date]);
			}

			// filter by category
			if ($request->has('category')) {
				$articleQuery->where('category', $request->category);
			}

			// filter by source
			if ($request->has('source')) {
				$articleQuery->where('sourceName', $request->source);
			}

			// user preferences: authors, categories, sources
			$filters = ['authors', 'categories', 'sources'];
			foreach ($filters as $filter) {
				if ($request->has($filter)) {
					$articleQuery->whereIn($filter, $request->{$filter});
				}
			}

			return new ArticleCollection($articleQuery->paginate(10));
		}

	}
