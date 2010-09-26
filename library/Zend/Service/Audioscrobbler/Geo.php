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
class Geo extends Audioscrobbler
{
    /**
     * Get all events in a specific location by country or city name.
     *
     * Optional params:
     * - location
     * - lat
     * - long
     * - page
     * - distance
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getEvents(array $params = array())
    {
        $this->compareParams($params, array('location', 'lat', 'long', 'page', 'distance'));

        return $this->doCall('geo.getEvents', $params);
    }

    /**
     * Get a chart of artists for a metro.
     *
     * Required params:
     * - country
     * - metro
     *
     * Optional params:
     * - start
     * - end
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetroArtistChart(array $params = array())
    {
        $this->compareParams($params, array('country', 'metro', 'start', 'end'));
        $this->requireParams($params, array('country', 'metro'));

        return $this->doCall('geo.getMetroArtistChart', $params);
    }

    /**
     * Get a chart of hyped (up and coming) artists for a metro.
     *
     * Required params:
     * - country
     * - metro
     *
     * Optional params:
     * - start
     * - end
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetroHypeArtistChart(array $params = array())
    {
        $this->compareParams($params, array('country', 'metro', 'start', 'end'));
        $this->requireParams($params, array('country', 'metro'));

        return $this->doCall('geo.getMetroHypeArtistChart', $params);
    }

    /**
     * Get a chart of tracks for a metro.
     *
     * Required params:
     * - country
     * - metro
     *
     * Optional params:
     * - start
     * - end
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetroHypeTrackChart(array $params = array())
    {
        $this->compareParams($params, array('country', 'metro', 'start', 'end'));
        $this->requireParams($params, array('country', 'metro'));

        return $this->doCall('geo.getMetroHypeTrackChart', $params);
    }

    /**
     * Get a chart of tracks for a metro.
     *
     * Required params:
     * - country
     * - metro
     *
     * Optional params:
     * - start
     * - end
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetroTrackChart(array $params = array())
    {
        $this->compareParams($params, array('country', 'metro', 'start', 'end'));
        $this->requireParams($params, array('country', 'metro'));

        return $this->doCall('geo.getMetroTrackChart', $params);
    }

    /**
     * Get a chart of the artists which make that metro unique.
     *
     * Required params:
     * - country
     * - metro
     *
     * Optional params:
     * - start
     * - end
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetroUniqueArtistChart(array $params = array())
    {
        $this->compareParams($params, array('country', 'metro', 'start', 'end'));
        $this->requireParams($params, array('country', 'metro'));

        return $this->doCall('geo.getMetroUniqueArtistChart', $params);
    }

    /**
     * Get a chart of tracks for a metro.
     *
     * Required params:
     * - country
     * - metro
     *
     * Optional params:
     * - start
     * - end
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetroUniqueTrackChart(array $params = array())
    {
        $this->compareParams($params, array('country', 'metro', 'start', 'end'));
        $this->requireParams($params, array('country', 'metro'));

        return $this->doCall('geo.getMetroUniqueTrackChart', $params);

    }

    /**
     * Get a list of available chart periods for this metro, expressed as date
     * ranges which can be sent to the chart services.
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetroWeeklyChartList()
    {
        return $this->doCall('geo.getMetroWeeklyChartlist');
    }

    /**
     * Get a list of valid countries and metros for use in the other webservices.
     *
     * Optional params:
     * - country
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getMetros(array $params = array())
    {
        $this->requireParams($params, array('country'));

        return $this->doCall('geo.getMetros', $params);
    }

    /**
     * Get the most popular artists on Last.fm by country.
     *
     * Required params:
     * - country
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopArtists(array $params = array())
    {
        $this->requireParams($params, array('country'));

        return $this->doCall('geo.getTopArtists', $params);
    }

    /**
     * Get the most popular tracks on Last.fm last week by country.
     *
     * Required params:
     * - country
     *
     * Optional params:
     * - location
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getTopTracks(array $params = array())
    {
        $this->compareParams($params, array('country', 'location'));
        $this->requireParams($params, array('country'));

        return $this->doCall('geo.getTopTracks', $params);
    }
}