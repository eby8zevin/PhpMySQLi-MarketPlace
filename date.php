<?php
function sekarang($mode='sekarang', $hari='1', $bulan='1', $tahun='1', $indo='Januari', $bln='1', $hari_ini='senin', $sekarang='jam'){
    $hari=date('d');
    $bulan=date('m');
    $tahun=date('Y');
    $indo=array('Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
    $bln=$indo[$bulan-1];
    $hari_ini="$hari $bln $tahun";
    $sekarang=date('H:i:s');
        if($mode=='jam'){
            return $sekarang;
        }elseif($mode=='tgl'){
            return $hari;
        }elseif($mode=='bln'){
            return $bln;
        }elseif($mode=='thn'){
            return $tahun;
        }else{
            return $hari_ini;
        }
}