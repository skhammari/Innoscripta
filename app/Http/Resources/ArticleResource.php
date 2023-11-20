<?php

	namespace App\Http\Resources;

	use Illuminate\Http\Request;
	use Illuminate\Http\Resources\Json\JsonResource;

	class ArticleResource extends JsonResource
	{
		/**
		 * Transform the resource into an array.
		 *
		 * @return array<string, mixed>
		 */
		public function toArray(Request $request): array
		{
			return [
				'id'           => $this->id,
				'title'        => $this->title,
				'content'      => $this->content,
				'author'       => $this->author,
				'published_at' => \Date::createFromFormat("Y-m-d H:i:s", $this->publishedAt)->format('Y-m-d H:i:s'),
				'category'     => $this->category,
				'image'        => $this->image,
				'link'         => $this->link,
				'created_at'   => $this->created_at->format('Y-m-d H:i:s'),
				'updated_at'   => $this->updated_at->format('Y-m-d H:i:s'),
			];
		}
	}
