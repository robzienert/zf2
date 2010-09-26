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
class Library extends Audioscrobbler
{
    /**
     * Add an album to a user's Last.fm library. This service requires user
     * authentication.
     *
     * Required params:
     * - artist
     * - album
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function addAlbum(array $params = array())
    {
        $this->requireParams($params, array('artist', 'album'));

        return $this->doSignedCall('library.addAlbum', $params);
    }

    /**
     * Add an artist to a user's Last.fm library. This service requires user
     * authentication.
     *
     * Required params:
     * - artist
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function addArtist(array $params = array())
    {
        $this->requireParams($params, array('artist'));

        return $this->doSignedCall('library.addArtist', $params);
    }

    /**
     * Add a track to a user's Last.fm library. This service requires user
     * authentication.
     *
     * Required params:
     * - artist
     * - track
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function addTrack(array $params = array())
    {
        $this->requireParams($params, array('artist', 'track'));

        return $this->doSignedCall('library.addTrack', $params);
    }

    /**
     * A paginated list of all the albums in a user's library, with play counts
     * and tag counts.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - artist
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getAlbums(array $params = array())
    {
        $this->compareParams($params, array('user', 'artist', 'limit', 'page'));
        $this->requireParams($params, array('user'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('library.getAlbums', $params);
    }

    /**
     * A paginated list of all the artists in a user's library, with play counts
     * and tag counts.
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
    public function getArtists(array $params = array())
    {
        $this->compareParams($params, array('user', 'limit', 'page'));
        $this->requireParams($params, array('user'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('library.getArtists', $params);
    }

    /**
     * A paginated list of all the tracks in a user's library, with play counts
     * and tag counts.
     *
     * Required params:
     * - user
     *
     * Optional params:
     * - artist
     * - album
     * - limit
     * - page
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTracks(array $params = array())
    {
        $this->compareParams($params, array('user', 'artist', 'album', 'limit', 'page'));
        $this->requireParams($params, array('user'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('library.getTracks', $params);
    }
}