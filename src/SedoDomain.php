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
     * @param array $domainEntries
     * @return $this
     */
    public function insert(array $domainEntries)
    {
        $this->method = 'DomainInsert';

        $this->params = $domainEntries;

        return $this->call();
    }

    /**
     * Delete domain from Sedo list
     * https://api.sedo.com/api/apidocs/API_Profi/functions/sedoapi_DomainDelete.html
     * @param array $domains
     * @return $this
     */
    public function delete(array $domains)
    {
        $this->method = 'DomainDelete';

        $this->params['domains'] = $domains;

        return $this->call();
    }
}