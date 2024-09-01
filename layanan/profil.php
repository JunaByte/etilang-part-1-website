<?php 
require_once('koneksi.php');

if($con){
	$id=$_POST['user'];
	$sql=mysqli_query($con, "SELECT * FROM `tb_masyarakat` WHERE username='$id'") or die (mysqli_error());
	if(mysqli_num_rows($sql)>0){
		$respon["Profil"]=array();
		while ($row=mysqli_fetch_array($sql)) {
			$hasil=array();
			$hasil["nama"] = $row['nama'];
			$hasil["jk"] = $row['jenis_kelamin'];
			$hasil["tempat"] = $row['tempat_lahir'];
			$hasil["tanggal"] = date('d F Y', strtotime($row['tanggal_lahir']));
			$hasil["tanggall"] = date('d-m-Y', strtotime($row['tanggal_lahir']));
			$hasil["alamat"] = $row['alamat'];
			$hasil["no"] = $row['no_hp'];
			$hasil["gambar"] = $lg.$row['foto_user'];
			array_push($respon["Profil"], $hasil);
			$respon["hasil"]=1;
		}
		echo json_encode($respon);
	}else{
		$respon["hasil"]=0;
		$respon["pesan"]="Hasil Tidak Ditemukan";
		echo json_encode($respon);
	}
}else{
	echo json_encode(array('respon'=> 'koneksi gagal'));
}
mysqli_close($con);



 ?>