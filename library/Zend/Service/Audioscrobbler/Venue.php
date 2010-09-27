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
class Venue extends Audioscrobbler
{
    /**
     * Get a list of upcoming events at this venue.
     *
     * Required params:
     * - venue
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getEvents(array $params = array())
    {
        $this->requireParams($params, array('venue'));

        return $this->doCall('venue.getEvents', $params);
    }

    /**
     * Get a paginated list of all the events held at this venue in the past.
     *
     * Required params:
     * - venue
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
        $this->requireParams($params, array('venue'));
        $this->compareParams($params, array('venue', 'page', 'limit'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 30, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('venue.getPastEvents', $params);
    }

    /**
     * Search for a venue by venue name.
     *
     * Required params:
     * - venue
     *
     * Optional params:
     * - page
     * - limit
     * - country
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function search(array $params = array())
    {
        $this->requireParams($params, array('venue'));
        $this->compareParams($params, array('page', 'limit', 'country'));

        $between = new BetweenValidator(array('min' => 1, 'max' => 50, 'inclusive' => true));
        if (isset($params['limit']) && !$between->isValid($params['limit'])) {
            throw new InvalidArgumentException('The value provided for the `limit` parameter is not valid');
        }

        return $this->doCall('venue.search', $params);
    }
}