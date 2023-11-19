<?php

namespace App\Console\Commands;

use App\Console\Services\NewsAPIService;
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
        $newsAPI = new NewsAPIService();
		dd($newsAPI->update());
    }
}
