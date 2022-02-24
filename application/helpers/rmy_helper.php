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

if (! function_exists('_dateShortID($date, $is_day=true)'))
{
	function _dateShortID($date, $is_day=true){
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

        return ($is_day ? $hari[$indexHari].', ' : '').$split[2].' '.$bulan[$split[1]-1].' '.$split[0];
    }
}

if (! function_exists('_timestampToTime($date)'))
{
	function _timestampToTime($date){
        $split = explode(' ', $date); //split timestamp
        return $split[1];
    }
}

if (! function_exists('_encrypt($text, $key, $encode)'))
{
	function _encrypt($text, $key, $encode=false){
        $METHOD = 'aes-256-ctr';
        $nonce_size = openssl_cipher_iv_length($METHOD);
        $nonce = openssl_random_pseudo_bytes($nonce_size);

        $ciphertext = openssl_encrypt(
            $text,
            $METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );

        // Now let's pack the IV and the ciphertext together
        // Naively, we can just concatenate
        if ($encode) {
            return base64_encode($nonce.$ciphertext);
        }
        return $nonce.$ciphertext;
    }
}

if (! function_exists('_decrypt($text, $key, $encode)'))
{
	function _decrypt($text, $key, $encode=false){
        $METHOD = 'aes-256-ctr';
        if ($encode) {
            $text = base64_decode($text, true);
            if ($text === false) {
                throw new Exception('Encryption failure');
            }
        }

        $nonce_size = openssl_cipher_iv_length($METHOD);
        $nonce = mb_substr($text, 0, $nonce_size, '8bit');
        $ciphertext = mb_substr($text, $nonce_size, null, '8bit');

        $plaintext = openssl_decrypt(
            $ciphertext,
            $METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );

        return $plaintext;
    }
}