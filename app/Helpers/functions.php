<?php

use App\Helpers\YandexGeocoder\YaGeo;

if (!function_exists('YaGeo')) {

    function YaGeo($query)
    {
        $YaGeo =  new YaGeo();

        $data = $YaGeo
            ->useAreaLimit(true)
            ->setArea(2, 2, 76.907177, 43.256131)
            ->setSCO('latlong')
            ->setQuery($query)
            ->load();
        return $data->getResults();

        // ->load()->getResponse();

        // return (object)[
        //     'rawData'       => $data->getRawData(),
        //     'full_address'  => $data->getFullAddress(),
        //     'country'       => $data->getCountry(),
        //     'region'        => $data->getRegion(),
        //     'district'      => $data->getDistrict(),
        //     'locality'      => $data->getLocality(),
        //     'street'        => $data->getStreet(),
        //     'houseNumber'   => $data->getHouseNumber(),
        //     'getLatitude'   => $data->getLatitude(),
        //     'getLongitude'  => $data->getLongitude(),
        //     'getType'       => $data->getType(),
        // ];
    }
}

if (!function_exists('is_valid_json')) {
    function is_valid_json($string)
    {
        // decode the JSON data
        $result = json_decode($string);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
                // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        if ($error !== '') {
            // throw the Exception or exit // or whatever :)
            return false;
        }

        // everything is OK
        return true;
    }
}

if (!function_exists('cdd')) {
    function cdd(...$args)
    {
        ob_start();
        print_r($args);
        $result = json_encode(ob_get_clean());
        echo "<script>console.log(`" . $result . "`);</script>";
        ob_end_flush();
    }
}
