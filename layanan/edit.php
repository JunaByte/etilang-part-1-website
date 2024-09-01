<?php 
require_once('koneksi.php');
$respon=array();

if ($_SERVER['REQUEST_METHOD']=='POST'){
	$id=$_POST['akses'];

	if ($id=="gfoto") {
		$user=$_POST['user'];
		$gambar= $_POST['gambar'];
		$url=date("d.m.yy-h.i.sa").".jpeg";

		$update=mysqli_query($con, "UPDATE `tb_masyarakat` SET `foto`='$url' WHERE `username`='$user'");
		$upload=$link.date("d.m.yy-h.i.sa").".jpeg";
		if($update){
			file_put_contents($upload, base64_decode($gambar));
			$respon['hasil']=1;
			$respon['pesan']='Update Berhasil';
		
		}else{
			$respon['hasil']=0;
			$respon['pesan']='Update Gagal';
			
		}
	}elseif ($id=="gpass") {
		$pbaru=$_POST['alamat'];
		$plama= $_POST['pass'];
		$user=$_POST['user'];
		$sql="SELECT * FROM `tb_masyarakat` WHERE username='$user'";
			$hasil= mysqli_query($con, $sql);
			if(mysqli_num_rows($hasil)>0){
				while ($row=mysqli_fetch_array($hasil)){
					$idu=$row['password'];
				}
			}
		
			if ($idu==$plama) {
				$update=mysqli_query($con, "UPDATE `tb_masyarakat` SET `password`='$pbaru' WHERE username='$user'");
				if($update){
					$respon['hasil']=1;
					$respon['pesan']='Update Berhasil';
				
				}else{
					$respon['hasil']=0;
					$respon['pesan']='Update Gagal';
					
				}
			}else{
				$respon['hasil']=2;
				$respon['pesan']='Update Gagal';
			}
	}elseif ($id=="editdata") {
		$user=$_POST['user'];
		$nama=$_POST['nama'];
		$jk=$_POST['jk'];
		$tempat_lahir=$_POST['tempat'];
		$tanggal_lahir=date('Y-m-d', strtotime($_POST['tanggal']));
		$alamat=$_POST['alamat'];
		$no=$_POST['no'];

		$update=mysqli_query($con, "UPDATE `tb_masyarakat` SET `nama`='$nama',`jenis_kelamin`='$jk',`tempat_lahir`='$tempat_lahir',`tanggal_lahir`='$tanggal_lahir',`alamat`='$alamat',`no_hp`='$no' WHERE `username`='$user'");
		if($update){
			$respon['hasil']=1;
			$respon['pesan']='Update Berhasil';
		}else{
			$respon['hasil']=0;
			$respon['pesan']='Update Gagal';
					
		}
			
	}
	
}else{
	$respon['hasil']=3;
		$respon['pesan']='Data Tidak diterima';
}
echo json_encode($respon);

 ?>


