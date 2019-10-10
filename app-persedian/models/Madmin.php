<?php 

/**
* @author  : Ismarianto Putra 
* @Created : At  7-31-2018
* @copyright :Ismarianto Putra
*/
class Madmin extends CI_model
{

function hitung_data($barang){
  return $this->db->query("SELECT sum(jumlah) as total_barang from rn_purchase where kode_purchase='$barang'");
}

  public function data_barang(){
   return $this->db->query("SELECT * from rn_barang a, rn_kategori b,rn_lokasi c,rn_suplier d,rn_admin e
     where a.id_kategori=b.id_kategori AND a.id_lokasi=c.id_lokasi AND 
     a.id_suplier=d.id_suplier AND a.id_admin=e.id_admin GROUP BY a.id_barang
     ");

 }



 public function data_barang_home(){
   return $this->db->query("SELECT * from rn_barang a, rn_kategori b,rn_lokasi c,rn_suplier d,rn_admin e
     where a.id_kategori=b.id_kategori AND a.id_lokasi=c.id_lokasi AND 
     a.id_suplier=d.id_suplier AND a.id_admin=e.id_admin order by a.id_barang DESC limit 5
     ");

 }

 public function data_suplier(){

  return $this->db->query("SELECT * from rn_suplier");

}

public function data_klien(){
  return $this->db->query("SELECT * from rn_client");
}
public function data_projek(){
  return $this->db->query("SELECT * from rn_project a,rn_client b where a.id_client=b.id_client group by a.id_project");
}
public function datta_kelompok(){
  return $this->db->query("SELECT * from rn_kategori");
}
public function lokasi_barang(){
  return $this->db->query("SELECT * from rn_lokasi");	
}
public function purchase_order(){

 return $this->db->query("SELECT 

  a.id_purchase,
  a.kode_purchase,
  a.suplier,
  a.alamat_sup,
  a.id_barang,
  a.tanggal_purchase,
  a.detail,
  a.jumlah,
  

  b.kode_barang,
  b.nama_barang,
  b.harga_beli,
  b.harga_jual,
  b.stok,
  b.satuan,
  b.id_lokasi,
  b.id_kategori,
  b.id_suplier,
  b.tanggal_barang,
  b.id_admin

  from rn_purchase a,rn_barang b
  where a.id_barang=b.id_barang group by a.kode_purchase");

}


/*cetak purchase*/


public function get_print_purchase($id){

 return $this->db->query("SELECT 

  a.id_purchase,
  a.kode_purchase,
  a.suplier,
  a.alamat_sup,
  a.id_barang,
  a.tanggal_purchase,
  a.detail,
  a.jumlah,
  

  b.kode_barang,
  b.nama_barang,
  b.harga_beli,
  b.harga_jual,
  b.stok,
  b.satuan,
  b.id_lokasi,
  b.id_kategori,
  b.id_suplier,
  b.tanggal_barang,
  b.id_admin

  from rn_purchase a,rn_barang b
  where a.id_barang=b.id_barang AND a.kode_purchase='$id' group by a.kode_purchase");

}

/*end purchase*/

public function penerimaan_barang(){
 return $this->db->query("SELECT * from rn_barang");
}
public function barang_keluar(){

 return $this->db->query("SELECT * from rn_barang_keluar a,rn_admin b,rn_barang c 	                      where a.id_barang=c.id_barang AND a.id_admin=b.id_admin GROUP BY a.id_barang_keluar");
}

/*bagian laporan system*/

public function laporan_stok_barang($dari='',$sampai=''){
 return $this->db->query("SELECT * from rn_barang a, rn_kategori b,rn_lokasi c,rn_suplier d,rn_admin e
   where a.tanggal_barang between '$dari' AND '$sampai'
   AND a.id_kategori=b.id_kategori AND a.id_lokasi=c.id_lokasi AND 
   a.id_suplier=d.id_suplier AND a.id_admin=e.id_admin GROUP BY a.id_barang
   ");

}

public function laporan_barang_masuk($dari='',$sampai=''){

 return $this->db->query("SELECT * from rn_barang_masuk a,rn_barang b 
  where a.tanggal_masuk between '$dari' AND '$sampai' AND a.id_barang=b.id_barang  GROUP BY a.id_barang_masuk");

}

public function laporan_barang_keluar($dari='',$sampai=''){
  return $this->db->query("SELECT * from rn_barang_keluar a,rn_admin b,rn_barang c
    where  a.tanggal_keluar between '$dari' AND '$sampai' AND a.id_barang=c.id_barang AND a.id_admin=b.id_admin GROUP BY a.id_barang_keluar");

}

public function cetak_faktur_keluar($id='')
{

 return $this->db->query("SELECT * from rn_barang_keluar a,rn_admin b,rn_barang c
  where a.id_barang_keluar='$id' AND a.id_barang=c.id_barang AND a.id_admin=b.id_admin GROUP BY a.id_barang_keluar");
}

public function update_barang($jumlah,$id)
{
 $this->db->query("UPDATE rn_barang set stok=stok-$jumlah where id_barang='$id'");
}

public function hak_akses(){

}

public function profil()
{

}

function identitas_($parameter){

 $query=$this->db->query("SELECT * from rn_setting where parameter ='".$parameter."'");
 return $query->row()->nilai; 
}

function hapus_purchase(){
  return $this->db->query("DELETE from tmp_purchase");
}
function get_barang_p($id){
  return $this->db->query("SELECT 
                  a.id_barang,
                  a.kode_barang,
                  a.nama_barang,
                  a.harga_beli,
                  a.harga_jual,
                  a.stok,
                  a.satuan,

                  b.id_purchase,
                  b.kode_purchase,
                  b.suplier,
                  b.alamat_sup,
                  b.id_barang,
                  b.tanggal_purchase,
                  b.detail,
                  b.jumlah

    from rn_barang a, rn_purchase b where a.id_barang=b.id_barang AND b.kode_purchase='$id' group by b.id_barang
    ");
}

/*function grafik*/
function grafik_barang(){
  return $this->db->query("SELECT 
     kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan, id_lokasi, id_kategori, id_suplier, tanggal_barang, id_admin 
    from rn_barang group by tanggal_barang desc
");
}

function cari_jumlah_barang_m($tanggal){
  return $this->db->query("SELECT 
     count(id_barang) as jumlah, tanggal_barang 
    from rn_barang where tanggal_barang='$tanggal'");
}

function grafik_barang_keluar(){ 
 return $this->db->query("SELECT * from rn_barang_keluar order by tanggal_keluar desc 

");
 }

function cari_jumlah_barang_k($tanggal){
  return $this->db->query("SELECT 
     count(id_barang_keluar) as jumlah_k, tanggal_keluar 
    from rn_barang_keluar where tanggal_keluar='$tanggal'");
}


}



