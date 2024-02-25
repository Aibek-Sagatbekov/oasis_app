<?php

namespace App\Helpers\YandexGeocoder;

use Yandex\Geocode\Api;
use Yandex\Geocode\Exception;
use Yandex\Geocode\Exception\CurlError;
use Yandex\Geocode\Exception\ServerError;

class YaGeo extends Api
{

    /**
     *
     * Load response
     *
     * Загрузка ответа
     *
     * @param array $options Curl options
     *
     * @return $this
     *
     * @throws Exception
     *
     * @throws Exception\CurlError
     *
     * @throws Exception\ServerError
     *
     */
    public function load(array $options = [])
    {

        $apiUrl = sprintf('https://geocode-maps.yandex.ru/%s/?%s', $this->_version, http_build_query($this->_filters));

        $curl = curl_init($apiUrl);

        $options += array(

            CURLOPT_RETURNTRANSFER => 1,

            CURLOPT_HTTPGET        => 1,

            CURLOPT_FOLLOWLOCATION => 1,

        );

        curl_setopt_array($curl, $options);

        $data = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {

            $error = curl_error($curl);

            curl_close($curl);

            throw new CurlError($error);
        }

        curl_close($curl);

        if (in_array($code, array(500, 502))) {

            $msg = strip_tags($data);

            throw new ServerError(trim($msg), $code);
        }

        $data = json_decode($data, true);

        if (empty($data)) {

            $msg = sprintf('Can\'t load data by url: %s', $apiUrl);

            throw new Exception($msg);
        }

        $this->_response = new YaResponse($data);

        return $this;
    }

    public function getResults(): array
    {
        $results = [];
        foreach ($this->_response->getList() as $_result) {
            $results[] =  (object)[
                'full_address'  => $_result->getFullAddress(),
                'country'       => $_result->getCountry(),
                'region'        => $_result->getRegion(),
                'district'      => $_result->getDistrict(),
                'locality'      => $_result->getLocality(),
                'street'        => $_result->getStreet(),
                'houseNumber'   => $_result->getHouseNumber(),
                'latitude'      => $_result->getLatitude(),
                'longitude'     => $_result->getLongitude(),
                'type'          => $_result->getType(),
            ];
        }

        return $results;
    }

    public function setSCO($sco = 'longlat')
    {
        $alowSCO = [
            'longlat', // — долгота, широта;
            'latlong',   // — широта, долгота.
        ];

        $this->_filters['sco'] = in_array($sco, $alowSCO) ? $sco : 'longlat';

        return $this;
    }
}
