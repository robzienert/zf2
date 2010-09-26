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
class Event extends Audioscrobbler
{
    const STATUS_ATTENDING = 0;
    const STATUS_MAYBE_ATTENDING = 1;
    const STATUS_NOT_ATTENDING = 2;
    
    /**
     * Set a user's attendance status for an event. This service requires user
     * authentication.
     *
     * Required params:
     * - event
     * - status
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function attend(array $params = array())
    {
        $this->requireParams($params, array('event', 'status'));

        $validStatus = array(self::STATUS_ATTENDING,
                             self::STATUS_MAYBE_ATTENDING,
                             self::STATUS_NOT_ATTENDING);
        if (!in_array($params['status'], $validStatus)) {
            throw new InvalidArgumentException('The value provided for the `status` parameter is not valid');
        }

        return $this->doSignedCall('event.attend', $params);
    }

    /**
     * Get a list of attendees for an event.
     *
     * Required params:
     * - event
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getAttendees(array $params = array())
    {
        $this->requireParams($params, array('event'));

        return $this->doCall('event.getAttendees', $params);
    }

    /**
     * Get the metadata for an event on Last.fm. Includes attendance and lineup
     * information.
     *
     * Required params:
     * - event
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getInfo(array $params = array())
    {
        $this->requireParams($params, array('event'));

        return $this->doCall('event.getInfo', $params);
    }

    /**
     * Get shouts for this event. Also available as an rss feed.
     *
     * Required params:
     * - event
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getShouts(array $params = array())
    {
        $this->requireParams($params, array('event'));

        return $this->doCall('event.getShouts', $params);
    }

    /**
     * Share an event with one or more Last.fm users or other friends. This
     * service requires user authentication.
     *
     * Required params:
     * - event
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
        $this->compareParams($params, array('event', 'recipient', 'public', 'message'));
        $this->requireParams($params, array('event', 'recipient'));

        $this->validateListLength($params['recipient'], 'recipient');

        return $this->doSignedCall('event.share', $params);
    }

    /**
     * Shout in this event's shoutbox. This service requires user authentication.
     *
     * Required params:
     * - event
     * - message
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function shout(array $params = array())
    {
        $this->requireParams($params, array('event', 'message'));

        return $this->doSignedCall('event.shout', $params);
    }
}