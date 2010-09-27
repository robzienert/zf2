<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Audioscrobbler
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @namespace
 */
namespace Zend\Service\Audioscrobbler;

/**
 * @uses       Zend_Validator_Between
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Audioscrobbler
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class User extends Audioscrobbler
{
    /**
     * Get a list of tracks by a given artist scrobbled by this user, including
     * scrobble time. Can be limited to specific timeranges, defaults to all time.
     *
     * Required params:
     * - user
     * - artist
     *
     * Optional params:
     * - startTimestamp
     * - page
     * - endTimestamp
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getArtistTracks(array $params = array())
    {
        $this->requireParams($params, array('user', 'artist'));
        $this->compareParams($params, array('user', 'artist', 'startTimestamp',
                                            'page', 'endTimestamp'));

        return $this->doCall('user.getArtistTracks', $params);
    }

    /**
     * Get a list of upcoming events that this user is attending. Easily
     * integratable into calendars, using the ical standard (see 'more formats'
     * section below).
     *
     * Required params:
     * - user
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getEvents(array $params = array())
    {
        $this->requireParams($params, array('user'));

        return $this->doCall('user.getEvents', $params);
    }

    /**
     * Get a list of the user's friends on Last.fm.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - recenttracks
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getFriends(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'recenttracks', 'limit', 'page'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('user.getFriends', $params);
    }

    /**
     * Get information about a user profile.
     *
     * Required params:
     * - user
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getInfo(array $params = array())
    {
        $this->requireParams($params, array('user'));

        return $this->doCall('user.getInfo', $params);
    }

    /**
     * Get the last 50 tracks loved by a user.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getLovedTracks(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'limit', 'page'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('user.getLovedTracks', $params);
    }

    /**
     * Get a list of a user's neighbours on Last.fm.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - limit
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getNeighbours(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'limit'));

        return $this->doCall('user.getNeighbours', $params);
    }

    /**
     * Get a paginated list of all events a user has attended in the past.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - page
     * - limit
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getPastEvents(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'page', 'limit'));

        return $this->doCall('user.getPastEvents', $params);
    }

    /**
     * Get a list of a user's playlists on Last.fm.
     *
     * Required params:
     * - user
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getPlaylists(array $params = array())
    {
        $this->requireParams($params, array('user'));

        return $this->doCall('user.getPlaylists', $params);
    }

    /**
     * Get a list of the recent Stations listened to by this user. This service
     * requires user authentication.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getRecentStations(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('limit', 'page'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 25, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doSignedCall('user.getRecentStations', $params);
    }

    /**
     * Get a list of the recent tracks listened to by this user. Also includes
     * the currently playing track with the nowplaying="true" attribute if the
     * user is currently listening.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getRecentTracks(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'limit', 'page'));

        return $this->doCall('user.getRecentTracks', $params);
    }

    /**
     * Get Last.fm artist recommendations for a user. This service requires
     * user authentication.
     *
     * @return Zend\Rest\Client\Result
     */
    public function getRecommendedArtists()
    {
        return $this->doSignedCall('user.getRecommendedArtists', $params);
    }

    /**
     * Get a paginated list of all events recommended to a user by Last.fm,
     * based on their listening profile. This service requires user
     * authentication.
     *
     * Optional params:
     * - page
     * - limit
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getRecommendedEvents(array $params = array())
    {
        $this->compareParams($params, array('page', 'limit'));

        $this->doSignedCall('user.getRecommendedEvents', $params);
    }

    /**
     * Get shouts for this user. Also available as an rss feed.
     *
     * Required params:
     * - user
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getShouts(array $params = array())
    {
        $this->requireParams($params, array('user'));

        return $this->doCall('user.getShouts', $params);
    }

    /**
     * Get the top albums listened to by a user. You can stipulate a time
     * period. Sends the overall chart by default.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - period
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopAlbums(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'period'));

        $validPeriods = array('overall', '7day', '3month', '6month', '12month');
        if (isset($params['period']) && !in_array($params['period'], $validPeriods)) {
            throw new InvalidArgumentException('The value provided for the `period` parameter is not valid');
        }

        return $this->doCall('user.getTopAlbums', $params);
    }

    /**
     * Get the top artists listened to by a user. You can stipulate a time
     * period. Sends the overall chart by default.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - period
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopArtists(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'period'));

        $validPeriods = array('overall', '7day', '3month', '6month', '12month');
        if (isset($params['period']) && !in_array($params['period'], $validPeriods)) {
            throw new InvalidArgumentException('The value provided for the `period` parameter is not valid');
        }

        return $this->doCall('user.getTopArtists', $params);
    }

    /**
     * Get the top tags used by this user.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - limit
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopTags(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'limit'));

        return $this->doCall('user.getTopTags', $params);
    }

    /**
     * Get the top tracks listened to by a user. You can stipulate a time
     * period. Sends the overall chart by default.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - period
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopTracks(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'period'));

        $validPeriods = array('overall', '7day', '3month', '6month', '12month');
        if (isset($params['period']) && !in_array($params['period'], $validPeriods)) {
            throw new InvalidArgumentException('The value provided for the `period` parameter is not valid');
        }

        return $this->doCall('user.getTopTracks');
    }

    /**
     * Get an album chart for a user profile, for a given date range. If no date
     * range is supplied, it will return the most recent album chart for this
     * user.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - from
     * - to
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyAlbumChart(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'from', 'to'));

        return $this->doCall('user.getWeeklyAlbumChart', $params);
    }

    /**
     * Get an artist chart for a user profile, for a given date range. If no
     * date range is supplied, it will return the most recent artist chart for
     * this user.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - from
     * - to
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyArtistChart(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'from', 'to'));

        return $this->doCall('user.getWeeklyArtistChart', $params);
    }

    /**
     * Get a list of available charts for this user, expressed as date ranges
     * which can be sent to the chart services.
     *
     * Required params:
     * - user
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyChartList(array $params = array())
    {
        $this->requireParams($params, array('user'));

        return $this->doCall('user.getWeeklyChartList', $params);
    }

    /**
     * Get a track chart for a user profile, for a given date range. If no date
     * range is supplied, it will return the most recent track chart for this
     * user.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - from
     * - to
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyTrackList(array $params = array())
    {
        $this->requireParams($params, array('user'));
        $this->compareParams($params, array('user', 'from', 'to'));

        return $this->doCall('user.getWeeklyTrackList', $params);
    }

    /**
     * Shout on this user's shoutbox. This service requires user authentication.
     *
     * Required params:
     * - user
     * - message
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function shout(array $params = array())
    {
        $this->requireParams($params, array('user', 'message'));

        return $this->doCall('user.shout', $params);
    }
}