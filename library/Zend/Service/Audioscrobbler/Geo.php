<?php

namespace Zend\Service\Audioscrobbler;

class Geo extends Audioscrobbler
{
    public function getEvents();
    public function getMetroArtistChart();
    public function getMetroHypeArtistChart();
    public function getMetroHypeTrackChart();
    public function getMetroTrackChart();
    public function getMetroUniqueArtistChart();
    public function getMetroUniqueTrackChart();
    public function getMetroWeeklyChartList();
    public function getMetros();
    public function getTopArtists();
    public function getTopTracks();
}