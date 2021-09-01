<?php

namespace App\Console\Commands;

use App\ExternalAPI\Coin;
use Illuminate\Console\Command;

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
    protected $description = 'Get BTC current rate with external API';

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
    public function handle(Coin $coin)
    {
        echo $coin->getCertainCoinPrice('BTC');
        return 0;
    }
}
