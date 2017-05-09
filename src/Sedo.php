<?php

namespace SedoClient;

use SoapClient;
use SedoClient\Exceptions\ClientErrorException;
use SedoClient\Exceptions\ClientFaultException;

class Sedo
{
    protected $client;

    protected $credentialParams;

    protected $params;

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

    protected $signKey;

    protected $partnerId;

    protected $username;

    protected $password;

    protected $request;

    protected $response;

    protected $method;

    protected $interface;

    public function __construct($username, $password, $signKey, $partnerId)
    {
        $this->username = $username;
        $this->password = $password;
        $this->signKey = $signKey;
        $this->partnerId = $partnerId;

        $this->client = new SoapClient(
            "https://api.sedo.com/api/sedointerface.php?wsdl",
            [
                'location' => "https://api.sedo.com/api/sedointerface.php",
                'soap_version' => SOAP_1_1,
                'encoding' => 'UTF-8',
                'uri' => 'urn:SedoInterface',
                'style' => SOAP_RPC,
                'use' => SOAP_ENCODED,
            ]
        );

        $this->credentialParams = [
            'username' => $this->username,
            'password' => $this->password,
            'partnerid' => $this->partnerId,
            'signkey' => $this->signKey
        ];

        $this->params = [];

        $this->interface = 'urn:SedoInterface';
    }

    /**
     * Call the SOAP request
     * @return $this
     * @throws ClientErrorException
     * @throws ClientFaultException
     */
    public function call()
    {
        $params = array_merge($this->params, $this->credentialParams);

        $this->request = $params;
        $this->response = $this->client->__soapCall($this->method, ['name' => $params]);

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
        return $this->request;
    }

    /**
     * @param mixed $request
     * @return Sedo
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     * @return Sedo
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
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
     * @return string
     */
    public function getInterface()
    {
        return $this->interface;
    }

    /**
     * @param string $interface
     * @return Sedo
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;
        return $this;
    }



}