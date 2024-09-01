<?php 
require_once('koneksi.php');
$respon=array();

if ($_SERVER['REQUEST_METHOD']=='POST'){
	$user=$_POST['user'];
	$nama=$_POST['nama'];
	$jk=$_POST['jk'];
	$tempat_lahir=$_POST['tempat'];
	$tanggal_lahir=date('Y-m-d', strtotime($_POST['tanggal']));
	$alamat=$_POST['alamat'];
	$no=$_POST['no'];
	$pw=$_POST['pass'];
	$gambar= $_POST['gambar'];
	$url=date("d.m.yy-h.i.sa").".jpeg";

	$register=mysqli_query($con, "INSERT INTO `tb_masyarakat`(`username`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `password`, `foto_user`,`token`) VALUES ('$user','$nama','$jk','$tempat_lahir','$tanggal_lahir','$alamat','$no','$pw','$url','0')");
	$upload=$link.date("d.m.yy-h.i.sa").".jpeg";
	if($register){
		file_put_contents($upload, base64_decode($gambar));
		$respon['hasil']=1;
		$respon['pesan']='Registrasi Berhasil';
	
	}else{
		$respon['hasil']=0;
		$respon['pesan']='Registrasi Gagal';
		
	}
}else{
	$respon['hasil']='0';
		$respon['pesan']='Data Tidak diterima';
}
echo json_encode($respon);

 ?>
