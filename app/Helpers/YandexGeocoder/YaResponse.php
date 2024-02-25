<?php

namespace App\Helpers\YandexGeocoder;

use Yandex\Geocode\Response;

class YaResponse extends Response
{

    /**
     *
     * Initial data
     *
     * Исходные данные
     *
     * @return ARRAY
     *
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     *
     * Get list
     *
     * @return \Yandex\Geocode\GeoObject[]
     *
     */
    public function getList()
    {
        return $this->_list;
        // foreach ($this->_list as $list) {

        //     return $list;
        // }
    }
}
