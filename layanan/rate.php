<?php 
require_once('koneksi.php');
$respon=array();

if ($_SERVER['REQUEST_METHOD']=='POST'){

		$id=$_POST['akses'];
		$isi=$_POST['alamat'];
		$user=$_POST['user'];
		

		$sql="SELECT max(id_feed) as maxKode FROM feedback";
		$hasil= mysqli_query($con, $sql);
		if(mysqli_num_rows($hasil)>0){
			while ($row=mysqli_fetch_array($hasil)){
				$kode=$row['maxKode'];
				$noUrut = (int) substr($kode, 3, 3);
	    		$noUrut++;
				$index=array();
				$char = "FB";
				$id_feed= $char.sprintf("%03s", $noUrut); 

			}
		}	

		$rating=mysqli_query($con, "INSERT INTO `feedback`(`id_feed`, `bintang`, `keterangan`) VALUES ('$id_feed','$id','$isi')");
		if($rating){
			$update=mysqli_query($con, "UPDATE `tb_pengaduan` SET `feed`='$id_feed' WHERE id_pengaduan='$user'");
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
