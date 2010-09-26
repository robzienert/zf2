<?php

namespace Zend\Service\Audioscrobbler;

class Tag extends Audioscrobbler
{
    public function getSimilar();
    public function getTopAlbums();
    public function getTopArtists();
    public function getTopTags();
    public function getTopTracks();
    public function getWeeklyArtistChart();
    public function getWeeklyChartList();
    public function search();
}