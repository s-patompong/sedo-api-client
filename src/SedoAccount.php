<?php


namespace SedoClient;


class SedoAccount extends Sedo
{
    /**
     * SedoAccount constructor.
     */
    public function __construct($username, $password, $signKey, $partnerId)
    {
        parent::__construct($username, $password, $signKey, $partnerId);
    }

    /**
     * Get account data
     * https://api.sedo.com/api/apidocs/API_Profi/functions/sedoapi_GetAccountData.html
     * @return $this
     */
    public function get()
    {
        $this->method = 'GetAccountData';

        return $this->call();
    }
}