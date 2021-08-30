<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Season;
use App\Models\Episode;
use App\Models\Serie;
use App\Services\SerieCreator;
use App\Services\SerieRemover;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SerieRemoverTest extends TestCase
{
    use RefreshDatabase;

    /** @var Serie */
    private $serie;

    protected function setUp(): void
    {
        parent::setUp();
        $serieCreator = new SerieCreator();
        $this->serie = $serieCreator->createSerie(
            'Nome da série',
            1,
            1
        );
    }

    public function testSerieRemover()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $serieRemover = new SerieRemover();
        $serieName = $serieRemover->remove($this->serie->id);
        $this->assertIsString($serieName);
        $this->assertEquals('Nome da série', $this->serie->name);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
