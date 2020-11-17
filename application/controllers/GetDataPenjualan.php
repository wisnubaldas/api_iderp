<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GetDataPenjualan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		// $this->load->library('Doctrine');
        $this->load->model('SAL211B1');
    }
    
    public function sales($date = null, $sj = null)
    {
        $kd = $this->input->get('kode');
        if(!$date)
        {
            return $this->stringhelper->to_json(['message'=>'Tanggal harus di set, format nya yyyy-mm-dd'],500);
        }
        
        $data = $this->SAL211B1->days_penjualan($date,$sj,$kd);
        if(!$data){
            return $this->stringhelper->to_json(['message'=>'Format data tidak sesuai yyyy-mm-dd'],500);
        }

        $result = [];
        foreach ($data->result() as $row)
        {
            $SJ = $this->stringhelper->clean_char($row->SJ);
            $JUAL = (integer) $row->JUAL;
            $HARGA = (integer) $row->HARGA;
            $KODE_BARANG = trim($row->KODE_BARANG);
            $TGL = $row->TGL;
            unset($row->TGL);
            unset($row->SJ);
            unset($row->JUAL);
            unset($row->KODE_BARANG);
            unset($row->HARGA);
            $DATA = json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            array_push($result, compact('SJ','JUAL','HARGA','KODE_BARANG','TGL','DATA'));
        }

        $this->stringhelper->to_json($result);
    }
}