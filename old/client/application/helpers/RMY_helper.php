<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('_limitText($string, $limit = 100)'))
{
	function _limitText($string, $limit = 100) {

        $string = strip_tags($string);
        if (strlen($string) > $limit) {

            // truncate string
            $stringCut = substr($string, 0, $limit);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }
}

if (! function_exists('_dateShortID($date)'))
{
	function _dateShortID($date){
        $bulan = array(
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        );

        $hari = array(
            'Monday' => 'Sen',
            'Tuesday' => 'Sel',
            'Wednesday' => 'Rab',
            'Thursday' => 'Kam',
            'Friday' => 'Jum',
            'Saturday' => 'Sab',
            'Sunday' => 'Min'
        );

        $split = explode(' ', $date); //split timestamp
        $split = explode('-', $split[0]); //split date
        $indexHari = date('l', strtotime($date));

        return $hari[$indexHari].', '.$split[2].' '.$bulan[$split[1]-1].' '.$split[0];
    }
}

if (! function_exists('_timestampToTime($date)'))
{
	function _timestampToTime($date){
        $split = explode(' ', $date); //split timestamp
        return $split[1];
    }
}