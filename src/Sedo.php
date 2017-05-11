<?php

namespace SedoClient;

use SedoClient\Exceptions\MaxElementsExceeded;
use SoapClient;
use SedoClient\Exceptions\ClientErrorException;
use SedoClient\Exceptions\ClientFaultException;

class Sedo
{
    const WSDL = 'https://api.sedo.com/api/sedointerface.php?wsdl';

    const URL = 'https://api.sedo.com/api/sedointerface.php';

    const URI = 'urn:SedoInterface';

    const ENCODING = 'UTF-8';

    const SOAP_VERSION = SOAP_1_1;

    const SOAP_STYLE = SOAP_RPC;

    const SOAP_USE = SOAP_ENCODED;

    protected $client;

    protected $credentialParams;

    protected $params;

    protected $signKey;

    protected $partnerId;

    protected $username;

    protected $password;

    protected $response;

    protected $method;

    public function __construct($username, $password, $signKey, $partnerId)
    {
        $this->username = $username;
        $this->password = $password;
        $this->signKey = $signKey;
        $this->partnerId = $partnerId;

        $this->client = new SoapClient(
            self::WSDL,
            [
                'location' => self::URL,
                'soap_version' => self::SOAP_VERSION,
                'encoding' => self::ENCODING,
                'uri' => self::URI,
                'style' => self::SOAP_STYLE,
                'use' => self::SOAP_USE,
            ]
        );

        $this->credentialParams = [
            'username' => $this->username,
            'password' => $this->password,
            'partnerid' => $this->partnerId,
            'signkey' => $this->signKey
        ];

        $this->params = [];
    }

    /**
     * Call the SOAP request
     * @return $this
     * @throws ClientErrorException
     * @throws ClientFaultException
     */
    public function call()
    {
        $this->response = $this->client->__soapCall($this->method, ['name' => $this->getRequest()]);

        return $this;
    }

    /**
     * @return SoapClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param SoapClient $client
     * @return Sedo
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return Sedo
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSignKey()
    {
        return $this->signKey;
    }

    /**
     * @param mixed $signKey
     * @return Sedo
     */
    public function setSignKey($signKey)
    {
        $this->signKey = $signKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @param mixed $partnerId
     * @return Sedo
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = $partnerId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Sedo
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return Sedo
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return array_merge($this->params, $this->credentialParams);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     * @return Sedo
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return array
     */
    public function getCredentialParams()
    {
        return $this->credentialParams;
    }

    /**
     * @param array $credentialParams
     * @return Sedo
     */
    public function setCredentialParams($credentialParams)
    {
        $this->credentialParams = $credentialParams;
        return $this;
    }

    /**
     * Verify the max element allowed for the data
     * @param $maxElements
     * @param $data
     * @param $key
     * @throws MaxElementsExceeded
     */
    protected function verifyMaxElements($maxElements, $data, $key)
    {
        if(count($data) > $maxElements) {
            throw new MaxElementsExceeded("Max element exceeded, amount of data in $key should not be more than $maxElements");
        }
    }
    
}
