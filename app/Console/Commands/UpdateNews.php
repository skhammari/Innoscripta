<?php

namespace App\Console\Commands;

use App\Services\GuardianService;
use App\Services\NewsAPIService;
use App\Services\NYTimesService;
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
    public function handle(NYTimesService $newsUpdater)
    {
		$news = $newsUpdater->update();
		dd($news);
    }
}
