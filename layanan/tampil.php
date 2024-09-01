<?php 
require_once('koneksi.php');

if($con){
	$jenis=$_POST['akses'];
	if ($jenis=="kategori") {
		$sql=mysqli_query($con, "SELECT * FROM `tb_bidang`");
		if(mysqli_num_rows($sql)>0){
			$respon["Kategori"]=array();
			while ($rows=mysqli_fetch_array($sql)) {
				$hasil=array();
				$hasil["nama"]=$rows["nama_bidang"];
				array_push($respon["Kategori"], $hasil);
				$respon["hasil"]=1;
			}
			echo json_encode($respon);
		}else{
			$respon["hasil"]=0;
			$respon["pesan"]="Hasil Tidak Ditemukan";
			echo json_encode($respon);
		}
	}elseif ($jenis=="tujuan"){
		$sql=mysqli_query($con, "SELECT * FROM `tujuan_pembayaran`");
		if(mysqli_num_rows($sql)>0){
			$respon["Tujuan"]=array();
			while ($rows=mysqli_fetch_array($sql)) {
				$hasil=array();
				$hasil["nama"]=$rows["nama_tujuan"];
				array_push($respon["Tujuan"], $hasil);
				$respon["hasil"]=1;
			}
			echo json_encode($respon);
		}else{
			$respon["hasil"]=0;
			$respon["pesan"]="Hasil Tidak Ditemukan";
			echo json_encode($respon);
		}
	}elseif ($jenis=="pasal"){
		$sql=mysqli_query($con, "SELECT * FROM `pasal`");
		if(mysqli_num_rows($sql)>0){
			$respon["Pasal"]=array();
			while ($rows=mysqli_fetch_array($sql)) {
				$hasil=array();
				$hasil["nama"]=$rows["nama_pasal"];
				array_push($respon["Pasal"], $hasil);
				$respon["hasil"]=1;
			}
			echo json_encode($respon);
		}else{
			$respon["hasil"]=0;
			$respon["pesan"]="Hasil Tidak Ditemukan";
			echo json_encode($respon);
		}
	}elseif ($jenis=="pengaduan") {
		$user=$_POST['user'];
		$sql=mysqli_query($con, "SELECT *, tb_tilang.alamat as almt, tb_tilang.no_hp as nhp,tb_tilang.keterangan as ket FROM `tb_tilang` 
			LEFt JOIN tb_tanggapan on tb_tilang.id_tanggapan=tb_tanggapan.id_tanggapan 
			JOIN tb_bidang on tb_tilang.kode_kategori=tb_bidang.kode_kategori 
			JOIN tb_masyarakat on tb_tilang.username=tb_masyarakat.username 
			JOIN tujuan_pembayaran on tb_tilang.tujuan=tujuan_pembayaran.id_tujuan WHERE tb_tilang.username='$user'");
		if(mysqli_num_rows($sql)>0){
			$respon["Pengaduan"]=array();
			while ($rows=mysqli_fetch_array($sql)) {
				$hasil=array();
				$hasil["tanggal"]=date('d F Y', strtotime($rows['tgl_pelanggaran']));
				$hasil["akses"]=$rows["id_tilang"];
				$hasil["ket"]=$rows["nama_bidang"];
				$hasil["uraian"]=$rows["ket"];
				$hasil["status"]=$rows["status"];
				$hasil["gambar"]=$fp.$rows["gambar"];
				$hasil["nama"]=$rows["nama_pelanggar"];
				$hasil["itp"]=$rows["isi_tanggapan"];
				$hasil["idp"]=$rows["id_tanggapan"];
				$hasil["user"]=$rows["nama"];
				$hasil["lat"]=$rows["lati"];
				$hasil["long"]=$rows["longi"];
				$hasil["alamat"]=$rows["almt"];
				$hasil["no"]=$rows["nhp"];
				$hasil["stnk"]=$rows["stnk"];
				$hasil["merk"]=$rows["merk"];
				$hasil["plat"]=$rows["plat"];
				$hasil["warna"]=$rows["warna"];
				$hasil["jadwal"]=date('d F Y', strtotime($rows['jadwal']));
				$hasil["lokasi"]=$rows["lokasi"];
				$hasil["tujuan"]=$rows["nama_tujuan"];
				array_push($respon["Pengaduan"], $hasil);
				$respon["hasil"]=1;
			}
			echo json_encode($respon);
		}else{
			$respon["hasil"]=0;
			$respon["pesan"]="Hasil Tidak Ditemukan";
			echo json_encode($respon);
		}
	}elseif ($jenis=="data_pasal") {
		$user=$_POST['user'];
		$sql=mysqli_query($con, "SELECT *FROM `tb_pelanggaran`
			JOIN pasal on tb_pelanggaran.id_pasal=pasal.id_pasal WHERE id_laporan='$user'");
		if(mysqli_num_rows($sql)>0){
			$respon["list"]=array();
			while ($rows=mysqli_fetch_array($sql)) {
				$hasil=array();
				$hasil["ket"]=$rows["keterangan"];
				$hasil["nama"]=$rows["nama_pasal"];
				array_push($respon["list"], $hasil);
				$respon["hasil"]=1;
			}
			echo json_encode($respon);
		}else{
			$respon["hasil"]=0;
			$respon["pesan"]="Hasil Tidak Ditemukan";
			echo json_encode($respon);
		}
	}
}else{
	echo json_encode(array('respon'=> 'koneksi gagal'));
}
mysqli_close($con);



?>