<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Season;
use App\Models\Episode;
use App\Models\Serie;
use App\Services\SerieCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SerieCreatorTest extends TestCase
{
    use RefreshDatabase;

    public function testSerieCreator()
    {
        $serieCreator = new SerieCreator();
        $serieName = 'NOME_DA_SERIE';
        $createdSerie = $serieCreator->createSerie($serieName, 3, 10);
        $this->assertInstanceOf(Serie::class, $createdSerie);
        $this->assertDatabaseHas('series', ['name' => $serieName]);
    }
}
