<?php namespace App\Http\Geo;

use DB;
use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;

class IpService {

    public function __construct(Config $config, Request $request)
    {
        $this->config = $config;
        $this->request = $request;
    }

    /**
     * @return string|null
     */
    public function getCountryCodeFromClientIp()
    {
        $ip = $this->request->ip();
        return $this->getCountryCodeFromIp($ip);
    }

    /**
     * @param $ip
     * @return string|null
     */
    public function getCountryCodeFromIp($ip)
    {
        $result = DB::select('SELECT
	            c.*
	        FROM
	            ip2nationCountries c,
	            ip2nation i
	        WHERE
	            i.ip < INET_ATON(?)
	            AND
	            c.code = i.country
	        ORDER BY
	            i.ip DESC
	        LIMIT 0,1', [$ip]);

       
        return $result !== null ?  array_shift($result) : null;
    }

}