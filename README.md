
# Innoscripta Assignment

Thank you for taking the time to reviewing this project. I will appreciate any feedback you may have. 

## Introduction
This project is a news aggregator backend developed as part of the Innoscripta assignment. It fetches articles from various news sources and provides an API for a frontend application to retrieve articles based on different criteria. The system is designed to regularly update the article database to ensure the latest news is always available.

## Requirements
The application meets the following requirements:
1. **Data Aggregation and Storage**: Fetches articles from selected data sources and stores them in a local database, regularly updating from live sources.
2. **API Endpoints**: Provides endpoints for retrieving articles with support for search queries, filtering (date, category, source), and user preferences.

### Data Sources
- [NewsAPI](https://newsapi.org)
- [The Guardian](https://content.guardianapis.com)
- [New York Times](https://www.nytimes.com)

## Technology Stack
- **Backend**: Laravel (PHP)
- **Database**: MySQL
- **Other Tools**: Laravel Sail, Composer

## Prerequisites
- PHP >= 8.1
- Composer
- Docker (for Laravel Sail)

## Setup Instructions
1. Install **Laravel Sail**.
2. run `mv .env.example .env`
3. get apikey for newsapi and nytimes and guardian.
4. Run `composer install` to install dependencies. 
5. Run `sail artisan key:generate` to set the application key. 
6. Run `sail artisan migrate` to create the database schema. 
7. Run `sail artisan update:news` to fetch initial news data.

## Usage and Examples
### Fetch Articles
**Endpoint**: `GET /api/articles/search`
**Parameters**:
- `category`: Filter by article category.
- `source`: Filter by news source.
- `title`: Search query.
- `begin_date`: Start date for date range filter.
- `end_date`: End date for date range filter.
- `page`: Page number.
- `authors`: Filter by article authors.
- `categories`: Filter by article categories.
- `sources`: Filter by news sources.

**Example Request**: `GET /api/articles/search?category=business&source=guardian`

**Example Response**:
```json
{
   "data": [
      {
         "id": 10,
         "title": "Microsoft hires Sam Altman to lead advanced AI research team after OpenAI ousting \u2013 business live",
         "content": "",
         "author": "",
         "published_at": "2023-11-20 09:54:01",
         "category": "business",
         "image": "",
         "link": null,
         "created_at": "2023-11-20 10:04:28",
         "updated_at": "2023-11-20 10:04:28"
      }
   ],
   "links": {
      "first": "http:\/\/localhost\/api\/articles\/search?page=1",
      "last": "http:\/\/localhost\/api\/articles\/search?page=1",
      "prev": null,
      "next": null
   },
   "meta": {
      "current_page": 1,
      "from": 1,
      "last_page": 1,
      "links": [
         {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
         },
         {
            "url": "http:\/\/localhost\/api\/articles\/search?page=1",
            "label": "1",
            "active": true
         },
         {
            "url": null,
            "label": "Next &raquo;",
            "active": false
         }
      ],
      "path": "http:\/\/localhost\/api\/articles\/search",
      "per_page": 10,
      "to": 1,
      "total": 1
   }
}
```

## Project Structure
### Command
- `app/Console/Commands/UpdateNews.php`: Scheduled task for news updates.

### DTO
- `app/DTO/ArticlesDTO.php`: Data transfer object for articles.

### Enums
- `app/Enums/ArticleCategoriesEnum.php`: Enum for article categories.

### Services
- `app/Services/NewsUpdaterInterface.php`: Interface for news updaters.
- `app/Services/GuardianService.php`: Service for The Guardian API.
- `app/Services/NewsApiService.php`: Service for NewsAPI.
- `app/Services/NYTimesService.php`: Service for New York Times API.

### HTTP Resources
- `app/Http/Resources/ArticleCollection.php`: Resource class for article collection.

### Tests
- `tests/Feature/GuardianServiceTest.php`: Tests for GuardianService.
- `tests/Feature/ArticleSearchTest.php`: Tests for ArticleSearch endpoint.
- `tests/Unit/ArticleDTOTest.php`: Tests for ArticleDTO.

## Features
- Backend system fetching and storing articles from various sources.
- Regular data updates from live sources.
- Unique ID generation for articles to prevent duplication.
- API endpoints for frontend interaction.

## Next Steps
- Expand testing coverage.
- Implement category fetching in NewsAPI.
- Cache responses in Redis.
- Add pagination for article endpoints.
- Add Error Handling.

## Contact Information
For any questions or feedback, please reach out to [skhammari@gmail.com](mailto:skhammari@gmail.com).