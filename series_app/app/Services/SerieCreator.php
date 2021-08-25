<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\{Serie, Season};

class SerieCreator
{
    public function createSerie(string $name, int $seasons_quantity, $episodes_quantity): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['name' => $name]);
        $this->createSeason($serie, $seasons_quantity, $episodes_quantity);
        DB::commit();

        return $serie;
    }

    private function createSeason(Serie $serie, int $episodes_quantity, int $seasons_quantity,)
    {
        for ($i = 1; $i <= $seasons_quantity; $i++) {
            $season = $serie->seasons()->create(['number' => $i]);
            $this->createEpisode($season, $episodes_quantity);
        }
    }
    private function createEpisode(Season $season, int $episodes_quantity)
    {
        for ($j = 1; $j <= $episodes_quantity; $j++) {
            $season->episodes()->create(['number' => $j]);
        }
    }
}
