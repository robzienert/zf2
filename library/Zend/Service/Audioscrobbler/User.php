<?php

namespace Zend\Service\Audioscrobbler;

class User extends Audioscrobbler
{
    public function getArtistTracks();
    public function getEvents();
    public function getFriends();
    public function getInfo();
    public function getLovedTracks();
    public function getNeighbours();
    public function getPastEvents();
    public function getPlaylists();
    public function getRecentStations();
    public function getRecentTracks();
    public function getRecommendedArtists();
    public function getRecommendedEvents();
    public function getShouts();
    public function getTopAlbums();
    public function getTopArtists();
    public function getTopTags();
    public function getWeeklyAlbumChart();
    public function getWeeklyArtistChart();
    public function getWeeklyChartList();
    public function getWeeklyTrackList();
    public function shout();
}