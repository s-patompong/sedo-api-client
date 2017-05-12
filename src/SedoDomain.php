<?php


namespace SedoClient;


class SedoDomain extends Sedo
{
    const MAX_ELEMENTS = 50;

    const CURRENCY_EUR = 0;

    const CURRENCY_USD = 1;

    const CURRENCY_GBP = 2;

    const ORDER_BY_NAME = 0;

    const ORDER_BY_INSERT_DATE = 1;

    const LIST_RESULT_DEFAULT = 10;

    /**
     * Insert domain into Sedo database
     * https://api.sedo.com/api/apidocs/API_Profi/functions/sedoapi_DomainInsert.html
     * @param array $domainEntries domain entries must be an array, each element much has key and value like this
     * The $domainEntries should have the size not more than 50
     * - string     $domain - the domain name in Punycode form [compulsory]
     * - array      $category - You can choose a maximum of 3 categories per domain and send it in array of int
     * - int        $forsale - 0=Not for sale, 1=For sale [compulsory]
     * - double     $price - The domain price. If no price is to be set, please set the value as 0. [compulsory]
     * - double     $minprice - The minimum price for the domain. For no minimum price, please set the value as 0. [compulsory]
     * - int        $fixedprice - 0=No, 1=Yes [compulsory]
     * - int        $currency - 0=EUR, 1=USD, 2=GBP [compulsory]
     * - string     $domainlanguage - ISO-639 two-letter language codes: (de=German, en=English ...) [compulsory]
     * @return $this
     */
    public function insert(array $domainEntries)
    {
        $this->verifyMaxElements(self::MAX_ELEMENTS, $domainEntries, 'domainEntries');

        $this->method = 'DomainInsert';

        $this->params = $domainEntries;

        return $this->call();
    }

    /**
     * Shortcut to park domains, this method will append the needed fields and call insert method
     * @param array $domains
     * @return SedoDomain
     */
    public function insertToPark(array $domains)
    {
        $this->verifyMaxElements(self::MAX_ELEMENTS, $domains, 'domains');

        $domainEntries = [];

        foreach ($domains as $domain) {
            $domainEntries[] = [
                'domain' => $domain,
                'category' => ['park'],
                'forsale' => 0,
                'price' => 0,
                'minprice' => 0,
                'fixedprice' => 0,
                'currency' => SedoDomain::CURRENCY_USD,
                'domainlanguage' => 'en',
            ];
        }

        return $this->insert($domainEntries);
    }

    /**
     * Delete domain from Sedo list
     * https://api.sedo.com/api/apidocs/API_Profi/functions/sedoapi_DomainDelete.html
     * @param array $domains
     * @return $this
     */
    public function delete(array $domains)
    {
        $this->verifyMaxElements(self::MAX_ELEMENTS, $domains, 'domains');

        $this->method = 'DomainDelete';

        $this->params['domains'] = $domains;

        return $this->call();
    }

    /**
     * List domains
     * https://api.sedo.com/api/apidocs/API_Profi/functions/sedoapi_DomainList.html
     * @param int $startFrom The start position
     * @param int $results number of results from the start position. Maximum 100.
     * @param int $orderBy The Orderby parameter sets the order of the recieved domains
     * @param array $domains an array with domain names
     * @return $this
     */
    public function list(int $startFrom = 0, $results = self::LIST_RESULT_DEFAULT, $orderBy = self::ORDER_BY_NAME, array $domains = [])
    {
        $this->method = 'DomainList';

        $this->params = [
            'startfrom' => $startFrom,
            'results' => $results,
            'orderby' => $orderBy,
        ];

        if(count($domains)) {
            $this->params['domain'] = $domains;
        }

        return $this->call();
    }
}