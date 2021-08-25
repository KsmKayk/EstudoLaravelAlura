<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Season;
use App\Models\Episode;

class seasonTest extends TestCase
{
    /** @var Season */
    private $season;

    public function setUp(): void
    {
        parent::setUp();

        $season = new Season();

        $episode1 = new Episode();
        $episode1->watched = true;
        $episode2 = new Episode();
        $episode2->watched = false;
        $episode3 = new Episode();
        $episode3->watched = true;

        $season->episodes->add($episode1);
        $season->episodes->add($episode2);
        $season->episodes->add($episode3);

        $this->season = $season;
    }


    public function testSearchWatchedEpisodes()
    {
        $watchedEpisodes = $this->season->getWatchedEpisodes();

        $this->assertCount(2, $watchedEpisodes);

        foreach ($watchedEpisodes as $episode) {
            $this->assertTrue($episode->watched);
        }
    }

    public function testSearchAllEpisodes()
    {
        $episodes = $this->season->episodes;
        $this->assertCount(3, $episodes);
    }
}
