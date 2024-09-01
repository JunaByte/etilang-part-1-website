<?php 
require_once('koneksi.php');
$respon=array();
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD']=='POST'){
	
	$user=$_POST['user'];
	$alamat=$_POST['alamat'];
	$kate=$_POST['ket'];
	$longi=$_POST['long'];
	$lati=$_POST['lat'];
	$tgl=date('Y-m-d', strtotime($_POST['tanggal']));
	$nama=$_POST['nama'];
	$no=$_POST['no'];
	$stnk=$_POST['stnk'];
	$merk=$_POST['merk'];
	$plat=$_POST['plat'];
	$warna=$_POST['warna'];
	$pasal=$_POST['pasal'];
	$uraian=$_POST['uraian'];
	$tujuan=$_POST['tujuan'];
	$foto=$_POST['gambar'];
	$date=date("d.m.yy-h.i.sa");
	$jam=date("G:i:s");
	$res = preg_replace(array('/^\[/','/\]$/'), '',$pasal); 
	$arr_kalimat = explode (", ",$res);

	$sql="SELECT max(id_tilang) as maxKode FROM tb_tilang";
	$hasil= mysqli_query($con, $sql);
	if(mysqli_num_rows($hasil)>0){
		while ($row=mysqli_fetch_array($hasil)){
			$kode=$row['maxKode'];
			$noUrut = (int) substr($kode, 3, 3);
			$noUrut++;
			$index=array();
			$char = "TL";
			$id_lapor= $char.sprintf("%03s", $noUrut); 

		}
	}

	$aks="SELECT * FROM `tb_bidang` WHERE nama_bidang='$kate'";
	$hasil_aks= mysqli_query($con, $aks);
	if(mysqli_num_rows($hasil_aks)>0){
		while ($row=mysqli_fetch_array($hasil_aks)){
			$id_kate=$row["kode_kategori"];
		}
	}	

	$tjn="SELECT * FROM `tujuan_pembayaran` WHERE nama_tujuan='$tujuan'";
	$hasil_tjn= mysqli_query($con, $tjn);
	if(mysqli_num_rows($hasil_tjn)>0){
		while ($row=mysqli_fetch_array($hasil_tjn)){
			$id_tjn=$row["id_tujuan"];
		}
	}	

	foreach ($arr_kalimat as $key => $value) {
		$aks="SELECT * FROM `pasal` WHERE nama_pasal='$value'";
		$hasil_pasal= mysqli_query($con, $aks);
		if(mysqli_num_rows($hasil_pasal)>0){
			while ($row=mysqli_fetch_array($hasil_pasal)){
				$id_pasal=$row["id_pasal"];
			}
		}	
		
		mysqli_query($con, "INSERT INTO `tb_pelanggaran`(`id_laporan`, `id_pasal`) VALUES ('$id_lapor','$id_pasal')");
	}
	$url=$id_lapor.".jpeg";

	$lapor=mysqli_query($con, "INSERT INTO `tb_tilang`(`id_tilang`, `jam`, `tgl`, `username`, `tgl_pelanggaran`, `lati`, `longi`, `nama_pelanggar`, `alamat`, `no_hp`, `stnk`, `merk`, `plat`, `warna`, `kode_kategori`, `keterangan`, `tujuan`, `gambar`, `status`, `id_tanggapan`) VALUES ('$id_lapor','$jam',CURRENT_DATE,'$user','$tgl','$lati','$longi','$nama','$alamat','$no','$stnk','$merk','$plat','$warna','$id_kate','$uraian','$id_tjn','$url','Proses','-')");
	$upload=$gp.$url;
	if($lapor){
		file_put_contents($upload, base64_decode($foto));
		$respon['hasil']=1;
		$respon['pesan']='Simpan Berhasil';
		echo json_encode($respon);
	}else{
		$respon['hasil']=0;
		$respon['pesan']='Simpan Gagal';
		echo json_encode($respon);
	}
}else{
	$respon['hasil']=3;
	$respon['pesan']='Data Tidak diterima';
	echo json_encode($respon);
}
echo json_encode($respon);

?>
