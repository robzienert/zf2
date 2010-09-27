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
class Tag extends Audioscrobbler
{
    /**
     * Search for tags similar to this one. Returns tags ranked by similarity,
     * based on listening data.
     *
     * Required params:
     * - tag
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getSimilar(array $params = array())
    {
        $this->requireParams($params, array('tag'));

        return $this->doCall('tag.getSimilar', $params);
    }

    /**
     * Get the top albums tagged by this tag, ordered by tag count.
     *
     * @return Zend\Rest\Client\Result
     */
    public function getTopAlbums()
    {
        return $this->doCall('tag.getTopAlbums');
    }

    /**
     * Get the top artists tagged by this tag, ordered by tag count.
     *
     * @return Zend\Rest\Client\Result
     */
    public function getTopArtists()
    {
        return $this->doCall('tag.getTopArtists');
    }

    /**
     * Fetches the top global tags on Last.fm, sorted by popularity (number of
     * times used).
     *
     * @return Zend\Rest\Client\Result
     */
    public function getTopTags()
    {
        return $this->doCall('tag.getTopTags');
    }

    /**
     * Get the top tracks tagged by this tag, ordered by tag count.
     * 
     * @return Zend\Rest\Client\Result
     */
    public function getTopTracks()
    {
        return $this->doCall('tag.getTopTracks');
    }

    /**
     * Get an artist chart for a tag, for a given date range. If no date range
     * is supplied, it will return the most recent artist chart for this tag.
     *
     * Required params:
     * - tag
     *
     * Optional params:
     * - from
     * - to
     * - limit
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyArtistChart(array $params = array())
    {
        $this->requireParams($params, array('tag'));
        $this->compareParams($params, array('tag', 'from', 'to', 'limit'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('tag.getWeeklyArtistChart', $params);
    }

    /**
     * Get a list of available charts for this tag, expressed as date ranges
     * which can be sent to the chart services.
     *
     * Required params:
     * - tag
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyChartList(array $params = array())
    {
        $this->requireParams($params, array('tag'));

        return $this->doCall('tag.getWeeklyChartList', $params);
    }

    /**
     * Search for a tag by name. Returns matches sorted by relevance.
     *
     * Required params:
     * - tag
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
        $this->requireParams($params, array('tag'));
        $this->compareParams($params, array('tag', 'limit', 'page'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 30, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('tag.search', $params);
    }

}