<?php

class LibraryRMYModel extends CI_Model {

    public $data;
    public function __construct(){
        parent::__construct();

        $this->data['berandaActive'] = '';
        $this->data['pertanyaanSayaActive'] = '';
        $this->data['pertanyaanMasukActive'] = '';
        $this->data['jawabanSayaActive'] = '';
        $this->data['jawabanSiapPublisActive'] = '';
        $this->data['jawabanTerpublisActive'] = '';
        $this->data['dataAkunActive'] = '';
        $this->data['akunNonaktifActive'] = '';

    }

    public function _dateIND($date){
        $bulan = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $hari = array(
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jum\'at',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Ahad'
        );

        $split = explode('-', $date);
        $indexHari = date('l', strtotime($date));

        return $hari[$indexHari].', '.$split[2].' '.$bulan[$split[1]-1].' '.$split[0];
    }

    public function _splitText($string, $limit = 100) {

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

    public function _rangking($array){
        
        // insert sort
        $n = count($array);
        for ($i = 0; $i < ($n - 1); $i++) {
            $key = $i + 1;
            $tmp = $array[$key]['similarity'];
            $replace = $array[$key];
            for ($j = ($i + 1); $j > 0; $j--) {
                if ($tmp < $array[$j - 1]['similarity']) {
                    $array[$j] = $array[$j - 1];
                    $key = $j - 1;
                }
            }
            $array[$key] = $replace;
        }

        return $array;
    }

    public function coba(){
        echo "<script>alert('berhasil');</script>";
    }

}