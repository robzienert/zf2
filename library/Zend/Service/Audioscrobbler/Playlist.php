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
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Audioscrobbler
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Playlist extends Audioscrobbler
{
    /**
     * Add a track to a Last.fm user's playlist. This service requires user
     * authentication.
     *
     * Required params:
     * - playlistID
     * - track
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function addTrack(array $params = array())
    {
        $this->requireParams($params, array('playlistID', 'track', 'artist'));

        return $this->doSignedCall('playlist.addTrack', $params);
    }

    /**
     * Create a Last.fm playlist on behalf of a user. This service requires user
     * authentication.
     *
     * Optional params:
     * - title
     * - description
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function create(array $params = array())
    {
        $this->compareParams($params, array('title', 'description'));

        return $this->doSignedCall('playlist.create', $params);
    }

    /**
     * Fetch XSPF playlists using a lastfm playlist url.
     *
     * Required params:
     * - playlistURL
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function fetch(array $params = array())
    {
        $this->requireParams($params, array('playlistURL'));

        return $this->doCall('playlist.fetch', $params);
    }
}