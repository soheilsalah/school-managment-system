<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class lms_db_migrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lms_db_migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        exec('php artisan --path=database/migrations/1-admin migrate');
        exec('php artisan --path=database/migrations/2-instructor migrate');
        exec('php artisan --path=database/migrations/3-parent migrate');
        exec('php artisan --path=database/migrations/4-student migrate');
        exec('php artisan --path=database/migrations/5-financial-role migrate');
        exec('php artisan --path=database/migrations/6-educational-stages migrate');
        exec('php artisan --path=database/migrations/7-subjects migrate');
        exec('php artisan --path=database/migrations/8-books migrate');
        exec('php artisan --path=database/migrations/9-expenses migrate');
        exec('php artisan --path=database/migrations/10-exams migrate');
    }
}
