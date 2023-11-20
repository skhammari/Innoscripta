<?php

	namespace App\Enums;

	enum ArticleCategoriesEnum: string
	{
		case BUSINESS = 'business';
		case ENTERTAINMENT = 'entertainment';
		case GENERAL = 'general';
		case HEALTH = 'health';
		case SCIENCE = 'science';
		case SPORTS = 'sports';
		case TECHNOLOGY = 'technology';

		public function value(): string
		{
			return $this->value;
		}

		public function label(): string
		{
			return match ($this->value) {
				'business' => 'Business',
				'entertainment' => 'Entertainment',
				'general' => 'General',
				'health' => 'Health',
				'science' => 'Science',
				'sports' => 'Sports',
				'technology' => 'Technology',
			};
		}
	}
