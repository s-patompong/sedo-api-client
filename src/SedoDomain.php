<?php


namespace SedoClient;


class SedoDomain extends Sedo
{
    public function __construct($username, $password, $signKey, $partnerId)
    {
        parent::__construct($username, $password, $signKey, $partnerId);
    }

    /**
     * Insert domain into Sedo database
     * https://api.sedo.com/api/apidocs/API_Profi/functions/sedoapi_DomainInsert.html
     * @param $domainEntries
     * @return $this
     */
    public function insert($domainEntries)
    {
        $this->method = 'DomainInsert';

        $this->params = $domainEntries;

        return $this->call();
    }
}