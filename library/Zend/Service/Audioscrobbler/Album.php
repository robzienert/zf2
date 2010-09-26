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
class Album extends Audioscrobbler
{
    /**
     * Tag an album using a list of user supplied tags. This service requires
     * user authentication.
     *
     * Required params:
     * - artist
     * - album
     * - tags
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function addTags(array $params)
    {
        $this->requireParams($params, array('artist', 'album', 'tags'));

        if (is_array($params['tags'])) {
            $params['tags'] = implode(',', $tags);
        }

        if (substr_count($params['tags'], ',') > 10) {
            throw new InvalidArgumentException(
                'There cannot be more than 10 values provided for the `tags` parameter');
        }

        return $this->doSignedCall('album.addTags', $params);
    }

    /**
     * Get a list of Buy Links for a particular Album. It is required that you
     * supply either the artist and track params or the mbid param.
     *
     * Optional params:
     * - artist
     * - album
     * - mbid
     * - country
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getBuyLinks(array $params)
    {
        $this->compareParams($params, array('artist', 'album', 'mbid', 'country'));

        if (!isset($params['mbid'])
            && (!isset($params['artist']) || !isset($params['album']))
        ) {
            throw new InvalidArgumentException(
                'It is required that you supply either the artist and album params or the mbid param');
        }

        return $this->doCall('album.getBuylinks', $params);
    }

    /**
     * Get the metadata for an album on Last.fm using the album name or a
     * musicbrainz id. See playlist.fetch on how to get the album playlist.
     *
     * Optional params:
     * - artist
     * - album
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
        $this->compareParams($params, array('artist', 'album', 'mbid', 'username', 'lang'));
        
        return $this->doCall('album.getInfo', $params);
    }

    /**
     * Get the tags applied by an individual user to an album on Last.fm. This
     * method requires user authentication.
     *
     * Required params:
     * - artist
     * - album
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTags(array $params = array())
    {
        $this->requireParams($params, array('artist', 'album'));

        return $this->doSignedCall('album.getTags', $params);
    }

    /**
     * Get the top tags for an album on Last.fm, ordered by popularity. This
     * methods requires user authentication.
     *
     * Required params:
     * - artist
     * - album
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopTags(array $params = array())
    {
        $this->requireParams($params, array('artist', 'album'));

        return $this->doSignedCall('album.getTopTags', $params);
    }

    /**
     * Remove a user's tag from an album. This service requires user authentication.
     *
     * Required params:
     * - artist
     * - album
     * - tag
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function removeTag(array $params = array())
    {
        $this->requireParams($params, array('artist', 'album', 'tag'));

        return $this->doSignedCall('album.removeTag', $params);
    }

    /**
     * Search for an album by name. Returns album matches sorted by relevance.
     *
     * Required params:
     * - album
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
        $this->compareParams($params, array('limit', 'page', 'album'));
        $this->requireParams($params, array('album'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 30, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('album.search', $params);
    }

    /**
     * Share an album with one or more Last.fm users or other friends. This
     * method requires user authentication.
     *
     * Required params:
     * - artist
     * - album
     * - recipient
     *
     * Optional params:
     * - public
     * - message
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function share(array $params = array())
    {
        $this->compareParams($params, array('artist', 'album', 'recipient', 'public', 'message'));
        $this->requireParams($params, array('artist', 'album', 'recipient'));
        
        $this->validateListLength($params['recipient'], 'recipient');

        return $this->doSignedCall('album.search', $params);
    }
}