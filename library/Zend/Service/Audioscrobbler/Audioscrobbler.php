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

use Zend\Rest\Client\RestClient;

/**
 * @uses       Zend_Rest_Client_RestClient
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Audioscrobbler
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Audioscrobbler
{
    const BASE_URI = 'http://ws.audioscrobbler.com/2.0/';

    /**
     * @var \Zend\Rest\Client\RestClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $params = array();

    /**
     * Constructor
     *
     * @param string $apiKey
     * @return void
     */
    public function __construct($apiKey)
    {
        $this->setRestClient(new RestClient(self::BASE_URI));
        $this->set('api_key', $apiKey);
    }

    public function authGetMobileSession();
    public function authGetSession();
    public function authGetToken();

    /**
     * Set a new REST client.
     *
     * @param RestClient $client
     * @return void
     */
    public function setRestClient(RestClient $client)
    {
        $this->client = $client;
    }

    /**
     * Returns the REST client.
     *
     * @return RestClient
     */
    public function getRestClient()
    {
        return $this->client;
    }

    /**
     * Generic set action for a url param.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function set($name, $value)
    {
        $this->params[$name] = urlencode($value);
    }

    /**
     * Returns a param value, or false if the param does not exist.
     *
     * @param string $name
     * @return string|false
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        } else {
            return false;
        }
    }

    /**
     * Throws an exception if and only if any user params are invalid.
     *
     * @access protected
     * @param array $params
     * @param array $validParams
     * @return void
     * @throws InvalidArgumentException
     */
    protected function compareParams(array $params, array $validParams)
    {
        $diff = array_diff(array_keys($params), $validParams);
        if ($diff) {
            throw new InvalidArgumentException(
                'The following parameters are invalid: ' . implode(', ', $diff));
        }
    }

    /**
     * Throws an exception if and only if any required user params are not
     * provided.
     *
     * @access protected
     * @param array $params
     * @param array $requiredParams
     * @return void
     * @throws InvalidArgumentException
     */
    protected function requireParams(array $params, array $requiredParams)
    {
        $diff = array_diff(array_keys($params), $requiredParams);
        if ($diff) {
            throw new InvalidArgumentException(
                'The following parameters are required: ' . implode(', ', $diff));
        }
    }

    /**
     * Throws a ComponentException if and only if a provided list
     * parameter exceeds the maximum provided length.
     *
     * @param string|array $list The list param, passed by-reference
     * @param string $name The name of the param
     * @param int $maxLength The maximum allowed list length
     * @return void
     * @throws InvalidArgumentException If the $maxLength value is not an integer
     * @throws ComponentException If the $list exceeds $maxLength
     */
    protected function validateListLength(&$list, $name, $maxLength = 10)
    {
        if (0 === intval($maxLength)) {
            throw new InvalidArgumentException('Max length must be an integer');
        }
        
        if (is_array($list)) {
            $list = implode(',', $list);
        }
        
        if (substr_count($list, ',') > $maxLength) {
            throw new ComponentException(
                "There cannot be more than $maxLength values provided for the `$name` parameter");
        }
    }

    /**
     * Queries an unauthenticated REST service and returns the response.
     *
     * @access protected
     * @param string $method Name of the Audioscrobbler service being accessed
     * @param array $params Parameters that are used to the service if needed
     * @return Zend\Rest\Client\Result
     */
    protected function doCall($method, array $params = array())
    {
        $params['method']  = $method;
        $params['api_key'] = $this->get('api_key');

        $response = $this->getRestClient()->restGet(self::BASE_URI, $params);

        return $response;
    }

    protected function doSignedCall($method, array $params = null);
}