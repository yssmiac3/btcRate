<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GetBTCRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:getBTC';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get BTC current rate with external API and put to cache';

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
        // делаем прикольчик для работы с внешней апишкой в целом
        // потом делаем прикольчик для работы с этой апишкой для битка
        // потом получаем тут эти данные через эти все прикольчики
        // такой вот прикольчик
//        $prikolckik = null;
//        $btcRate = $prikolckik->getBtcRate();
        Cache::put('btcRate', 20000);
        return 0;
    }
}
