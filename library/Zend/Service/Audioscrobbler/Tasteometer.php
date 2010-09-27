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
class Tasteometer extends Audioscrobbler
{
    /**
     * Get a Tasteometer score from two inputs, along with a list of shared
     * artists. If the input is a User or a Myspace URL, some additional
     * information is returned.
     *
     * @param array $type A two-index array; "user", "artists" or "myspace"
     * @param array $value A two-index array; Last.fm username, comma-separated artist names, MySpace profile URL
     * @param int $limit Number of shared artists to return
     * @return Zend\Rest\Client\Result
     * @throws InvalidArgumentException If any params are invalid
     */
    public function compare(array $type, array $value, $limit = 5)
    {
        if (count($type) != 2) {
            throw new InvalidArgumentException('The value provided for the `type` parameter is not valid');
        }

        if (count($value) != 2) {
            throw new InvalidArgumentException('The value provided for the `value` parameter is not valid');
        }

        $params = array(
            'type1'  => $type[0],
            'type2'  => $type[1],
            'value1' => $value[0],
            'value2' => $value[1],
            'limit'  => $limit,
        );

        return $this->doCall('tasteometer.compare', $params);
    }
}