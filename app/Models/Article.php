<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;

	class Article extends Model
	{
		use HasFactory;

		protected $fillable = [
			'uniqueId',
			'title',
			'content',
			'description',
			'url',
			'image',
			'sourceName',
			'sourceId',
			'author',
			'category',
			'publishedAt',
		];
	}
