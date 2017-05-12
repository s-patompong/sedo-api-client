<?php

namespace SedoClient;

use SedoClient\Exceptions\MaxElementsExceeded;
use SoapClient;

class Sedo
{
    protected $client;

    protected $credentialParams;

    protected $params;

    protected $signKey;

    protected $partnerId;

    protected $username;

    protected $password;

    protected $response;

    protected $method;

    protected $timeout;

    protected $soapExceptions;

    protected $wsdl;

    /**
     * Sedo constructor.
     * @param $username
     * @param $password
     * @param $signKey
     * @param $partnerId
     * @param int $timeout
     * @param bool $exceptions
     * @param string $wsdl
     * @throws \SoapFault
     */
    public function __construct($username, $password, $signKey, $partnerId, $timeout = 30, $exceptions = true, $wsdl = 'https://api.sedo.com/api/sedointerface.php?wsdl') {
        $this->username = $username;
        $this->password = $password;
        $this->signKey = $signKey;
        $this->partnerId = $partnerId;
        $this->timeout = $timeout;
        $this->soapExceptions = $exceptions;
        $this->wsdl = $wsdl;

        $this->client = new SoapClient(
            $this->wsdl,
            [
                'exceptions' => $exceptions,
                'connection_timeout' => $timeout,
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
        if (count($data) > $maxElements) {
            throw new MaxElementsExceeded("Max element exceeded, amount of data in $key should not be more than $maxElements");
        }
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     * @return Sedo
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSoapExceptions()
    {
        return $this->soapExceptions;
    }

    /**
     * @param bool $soapExceptions
     * @return Sedo
     */
    public function setSoapExceptions($soapExceptions)
    {
        $this->soapExceptions = $soapExceptions;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * @param mixed $wsdl
     * @return Sedo
     */
    public function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;
        return $this;
    }

    /**
     * Get response as array
     * @return mixed
     */
    public function toArray()
    {
        return json_decode($this->toJson(), true);
    }

    /**
     * Get response as json
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->response);
    }

}
