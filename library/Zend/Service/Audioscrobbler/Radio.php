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
class Radio extends Audioscrobbler
{
    /**
     * Fetch new radio content periodically in an XSPF format. This service
     * requires user authentication.
     *
     * Optional params:
     * - discovery
     * - rtp
     * - bitrate
     * - buylinks
     * - speed_multiplier
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function getPlaylist(array $params = array())
    {
        $this->compareParams($params, array('discovery', 'rtp', 'bitrate',
                                            'buylinks', 'speed_multiplier'));

        if (isset($params['bitrate'])
            && ($params['bitrate'] != 64 || $params['bitrate'] != 128)
        ) {
            throw new InvalidArgumentException('The value provided for the `bitrate` parameter is not valid');
        }

        if (isset($params['speed_multiplier'])
            && ($params['speed_multiplier'] != '1.0' || $params['speed_multiplier'] != '2.0')
        ) {
            throw new InvalidArgumentException('The value provided for the `speed_multiplier` parameter is not valid');
        }

        return $this->doSignedCall('radio.getPlaylist', $params);
    }

    /**
     * Tune in to a Last.fm radio station. This service requires user
     * authentication.
     *
     * Required params:
     * - station
     *
     * Optional params:
     * - lang
     *
     * @param array $params An associative array of the request params
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function tune(array $params = array())
    {
        $this->compareParams($params, array('station', 'lang'));
        $this->requireParams($params, array('station'));

        return $this->doSignedCall('radio.tune', $params);
    }
}