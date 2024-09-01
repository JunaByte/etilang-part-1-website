<?php 
require_once('koneksi.php');
$respon=array();
if ($_SERVER['REQUEST_METHOD']=='POST'){
	
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$token=$_POST['token'];

	$edit="UPDATE `tb_masyarakat` SET `token`='$token' WHERE username='$user'";
	$hedit=mysqli_query($con, $edit);
if ($hedit) {
	$sql="SELECT * FROM `tb_masyarakat` WHERE username='$user' and password='$pass'";
	$hasil= mysqli_query($con, $sql);
	if(mysqli_num_rows($hasil)>0){
		$respon["login"]=array();
		while ($row=mysqli_fetch_array($hasil)){
			$index=array();
			$index["nama"] = $row['nama'];
			$index["user"] = $row['username'];
			array_push($respon["login"], $index);
			$respon["hasil"]=1;
			$respon["pesan"]="sukses";

		}echo json_encode($respon);
		
	}else{
		$respon["hasil"]=0;
			$respon["pesan"]="Gagal";
			echo json_encode($respon);
	}
	mysqli_close($con);


}
	
 }
 ?>
