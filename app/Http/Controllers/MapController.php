<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;
use Log;

class MapController extends Controller
{

    public function lookUp() {
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            // $ip = '186.83.228.58';
            $ip = '82.132.243.29';

            Log::info('local');
        
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
            Log::info('server: '.$_SERVER['REMOTE_ADDR']);
        }

        try {
            $url = 'http://api.ipstack.com/'.$ip.'?access_key=38107d9070f4d53bb8adaa47f4bbca9d';
            $json  = json_decode(file_get_contents($url), true); 
        } catch (exception $e) {
            $json = [];
        }

        //rands for testing
        // $json['latitude'] = rand(0,90);
        // $json['longitude'] = rand(0,90);
        // $json['city'] = rand() * 20 .'sville';

        return $json;
    }

    /**
     * Looks up ip
     */
    public function hit() {

        //ISSUE WITH NOT DOING SAME ONE

        $json = $this->lookUp();

        $point = new Point;
        /* Check existing */
        if ($point::where('latitude', '=', $json['latitude'])->exists()
        && $point::where('longitude', '=', $json['longitude'])->exists()) {
            /* point already exists */
        } else {
            /* Add new */
            $point->city = $json['city'];
            $point->latitude = $json['latitude'];
            $point->longitude = $json['longitude'];
            $point->save();
        }

        return $json;
    }

    /**
     * Grabs points from db
     */
    public function points() {

        /* add point to database */
        $this->hit();

        $point = new Point;
        $points = $point->all()->toArray();

        /* get points from db */
        
        /**
         * Point:
         * |'city'|'latitude'|'longitude'|'date modified'|'current user'|
         * 
         * current user not in db
         */

        // $points = [
        //     ['ZANZIBAR', -6.13, 33.31, '1598968058', false],
        //     ['TOKYO', 35.68, 139.76, '1598967058', false],
        //     ['AUCKLAND', -36.85, 174.78, '1598957058', false]
        // ];

                //     ["ZANZIBAR", -6.13, 39.31],
                //     ["TOKYO", 35.68, 139.76],
                //     ["AUCKLAND", -36.85, 174.78],
                //     ["BANGKOK", 13.75, 100.48],
                //     ["DELHI", 29.01, 77.38],
                //     ["SINGAPORE", 1.36, 103.75],
                //     ["BRASILIA", -15.67, -47.43],
                //     ["RIO DE JANEIRO", -22.9, -43.24],
                //     ["TORONTO", 43.64, -79.4],
                //     ["EASTER ISLAND", -27.11, -109.36],
                //     ["SEATTLE", 47.61, -122.33],
                //     // ["LONDON", 51.5072, -0.1275]
        
        return $points;
    }

    /**
     * Returns map
     */
    public function index() {

        return view('map');
    }
}
