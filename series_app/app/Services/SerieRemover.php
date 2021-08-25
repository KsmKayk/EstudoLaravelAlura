<?php

namespace App\Services;

use App\Models\{Serie, Episode, Season};
use Illuminate\Support\Facades\DB;

class SerieRemover
{
    public function remove(int $id): string
    {
        DB::beginTransaction();
        $serie = Serie::find($id);
        $serieName = $serie->name;
        DB::commit();

        $this->removeSerie($serie);


        return $serieName;
    }

    private function removeSerie(Serie $serie)
    {
        $serie->seasons->each(function (Season $season) {
            $this->removeSeason($season);
        });

        $serie->delete();
    }

    private function removeSeason(Season $season)
    {
        $season->episodes->each(function (Episode $episode) {
            $this->removeEpisode($episode);
        });
        $season->delete();
    }
    private function removeEpisode(Episode $episode)
    {
        $episode->delete();
    }
}
