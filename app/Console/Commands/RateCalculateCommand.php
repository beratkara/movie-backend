<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Rate;
use Illuminate\Console\Command;

class RateCalculateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Oy verilmiş filmlerin ortalamasını hesaplar';

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
     * @return bool
     */
    public function handle(): bool
    {
        $rates = Rate::query()->selectRaw('AVG(rate) average, movie_id')->groupBy('movie_id')->get();

        $rates->each(function ($rate) {
            Movie::query()->where('id', $rate->movie_id)->update([
                'average' => $rate->average
            ]);
        });

        return true;
    }
}
