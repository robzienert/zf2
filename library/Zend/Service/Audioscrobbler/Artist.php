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

use Zend\Validator\Between as BetweenValidator;

/**
 * @uses       Zend_Validator_Between
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Audioscrobbler
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Artist extends Audioscrobbler
{
    /**
     * Tag an artist with one or more user supplied tags. This service requires
     * user authentication.
     *
     * Required params:
     * - artist
     * - tags
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function addTags(array $params = array())
    {
        $this->requireParams($params, array('artist', 'tags'));
        $this->validateListLength($params['tags'], 'tags');

        return $this->doSignedCall('artist.addTags', $params);
    }

    /**
     * Get a list of upcoming events for this artist. Easily integratable into
     * calendars, using the ical standard.
     *
     * Required Params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getEvents(array $params = array())
    {
        $this->requireParams($params, array('artist'));
        
        return $this->doCall('artist.getEvents', $params);
    }

    /**
     * Get Images for this artist in a variety of sizes.
     *
     * Required params:
     * - artist
     *
     * Optional params:
     * - page
     * - limit
     * - order
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getImages(array $params = array())
    {
        $this->compareParams($params, array('artist', 'page', 'limit', 'order'));
        $this->requireParams($params, array('artist'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        if (!in_array($params['order'], array('popularity', 'dateadded'))) {
            throw new InvalidArgumentException('The `order` parameter must be either `popularity` or `dateadded`');
        }

        return $this->doCall('artist.getImages', $params);
    }

    /**
     * Get the metadata for an artist on Last.fm. Includes biography.
     *
     * Optional params:
     * - artist
     * - mbid
     * - username
     * - lang
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getInfo(array $params = array())
    {
        $this->compareParams($params, array('artist', 'mbid', 'username', 'lang'));

        return $this->doCall('artist.getInfo', $params);
    }

    /**
     * Get a paginated list of all the events this artist has played at in the past.
     *
     * Required params:
     * - artist
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
        $this->compareParams($params, array('artist', 'page', 'limit'));
        $this->requireParams($params, array('artist'));

        return $this->doCall('artist.getPastEvents', $params);
    }

    /**
     * Get a podcast of free mp3s based on an artist.
     *
     * Required params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getPodcast(array $params = array())
    {
        $this->requireParams($params, array('artist'));

        return $this->doCall('artist.getPodcast', $params);
    }

    /**
     * Get shouts for this artist. Also available as an rss feed.
     *
     * Required params:
     * - artist
     *
     * Optional params:
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getShouts(array $params = array())
    {
        $this->compareParams($params, array('artist', 'limit', 'page'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value providied for the `limit` parameter is not valid');
        }

        return $this->doCall('artist.getShouts', $params);
    }

    /**
     * Get all the artists similar to this artist.
     *
     * Required params:
     * - artist
     *
     * Optional params:
     * - limit
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getSimilar(array $params = array())
    {
        $this->compareParams($params, array('artist', 'limit'));
        $this->requireParams($params, array('artist'));

        return $this->doCall('artist.getSimilar', $params);
    }

    /**
     * Get the tags applied by an individual user to an artist on Last.fm. This
     * method requires user authentication.
     *
     * Required params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTags(array $params = array())
    {
        $this->requireParams($params, array('artist'));

        return $this->doSignedCall('artist.getTags', $params);
    }

    /**
     * Get the top albums for an artist on Last.fm, ordered by popularity.
     *
     * Required params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopAlbums(array $params = array())
    {
        $this->requireParams($params, array('artist'));

        return $this->doCall('artist.getTopAlbums', $params);
    }

    /**
     * Get the top fans for an artist on Last.fm, based on listening data.
     *
     * Required params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopFans(array $params = array())
    {
        $this->requireParams($params, array('artist'));

        return $this->doCall('artist.getTopFans', $params);
    }

    /**
     * Get the top tags for an artist on Last.fm, ordered by popularity.
     *
     * Required params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopTags(array $params = array())
    {
        $this->requireParams($params, array('artist'));

        return $this->doCall('artist.getTopTags', $params);
    }

    /**
     * Get the top tracks by an artist on Last.fm, ordered by popularity.
     *
     * Required params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopTracks(array $params = array())
    {
        $this->requireParams($params, array('artist'));

        return $this->doCall('artist.getTopTracks', $params);
    }

    /**
     * Remove a user's tag from an artist. This service requires user authenticaiton.
     *
     * Required params:
     * - artist
     * - tag
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function removeTag(array $params = array())
    {
        $this->requireParams($params, array('artist', 'tag'));

        return $this->doSignedCall('artist.removeTag', $params);
    }

    /**
     * Search for an artist by name. Returns artist matches sorted by relevance.
     *
     * Required params:
     * - artist
     *
     * Optional params:
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function search(array $params = array())
    {
        $this->compareParams($params, array('artist', 'limit', 'page'));
        $this->requireParams($params, array('artist'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 30, 'inclusive' => true));
        if (isset($params['limit']) && !$betwee->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('artist.search', $params);
    }

    /**
     * Share an artist with Last.fm users or other friends. This service requires
     * user authentication.
     *
     * Required params:
     * - artist
     * - recipient
     *
     * Optional params:
     * - message
     * - public
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function share(array $params = array())
    {
        $this->compareParams($params, array('artist', 'recipient', 'message', 'public'));
        $this->requireParams($params, array('artist', 'recipient'));

        $this->validateListLength($params['recipient'], 'recipient');

        return $this->doSignedCall('artist.search', $params);
    }

    /**
     * Shout in this artist's shoutbox. This service requires user authentication.
     *
     * Required params:
     * - artist
     * - message
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function shout(array $params = array())
    {
        $this->requireParams($params, array('artist', 'message'));

        return $this->doSignedCall('artist.shout', $params);
    }
}