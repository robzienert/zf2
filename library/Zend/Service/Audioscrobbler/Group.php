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
class Group extends Audioscrobbler
{
    /**
     * Get the hype list for a group.
     *
     * Required params:
     * - group
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getHype(array $params = array())
    {
        $this->requireParams($params, array('group'));

        return $this->doCall('group.getHype', $params);
    }

    /**
     * Get a list of members for this group.
     *
     * Required params:
     * - group
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMembers(array $params = array())
    {
        $this->requireParams($params, array('group'));

        return $this->doCall('group.getMembers', $params);
    }

    /**
     * Get an album chart for a group, for a given date range. If no date range
     * is supplied, it will return the most recent album chart for this group.
     *
     * Required params:
     * - group
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
        $this->compareParams($params, array('group', 'from', 'to'));
        $this->requireParams($params, array('group'));

        return $this->doCall('group.getWeeklyAlbumChart', $params);
    }
    
    /**
     * Get an artist chart for a group, for a given date range. If no date range
     * is supplied, it will return the most recent album chart for this group.
     *
     * Required params:
     * - group
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
        $this->compareParams($params, array('group', 'from', 'to'));
        $this->requireParams($params, array('group'));

        return $this->doCall('group.getWeeklyArtistChart', $params);
    }

    /**
     * Get a list of available charts for this group, expressed as date ranges
     * which can be sent to the chart services.
     *
     * Required params:
     * - group
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyChartList(array $params = array())
    {
        $this->requireParams($params, array('group'));

        return $this->doCall('group.getWeeklyChartList', $params);
    }

    /**
     * Get a track chart for a group, for a given date range. If no date range
     * is supplied, it will return the most recent album chart for this group.
     *
     * Required params:
     * - group
     *
     * Optional params:
     * - from
     * - to
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getWeeklyTrackChart(array $params = array())
    {
        $this->compareParams($params, array('group', 'from', 'to'));
        $this->requireParams($params, array('group'));

        return $this->doCall('group.getWeeklyTrackChart', $params);
    }
}