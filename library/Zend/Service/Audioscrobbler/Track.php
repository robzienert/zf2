<?php

namespace Zend\Service\Audioscrobbler;

class Track extends Audioscrobbler
{
    public function addTags();
    public function ban();
    public function getBuyLinks();
    public function getFingerprintMetadata();
    public function getInfo();
    public function getSimilar();
    public function getTags();
    public function getTopFans();
    public function getTopTags();
    public function love();
    public function removeTag();
    public function search();
    public function share();
}