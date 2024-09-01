<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "dragonxp_etilang"; // Ubah sesuai dengan username database Anda
$password = "Okitosenpai123."; // Ubah sesuai dengan password database Anda
$dbname = "dragonxp_etilang"; // Ubah sesuai dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari request
$tgl = isset($_POST['tgl']) ? $_POST['tgl'] : '';
$nama_petugas = isset($_POST['nama_petugas']) ? $_POST['nama_petugas'] : '';
$nama_pelanggar = isset($_POST['nama_pelanggar']) ? $_POST['nama_pelanggar'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$nohp = isset($_POST['nohp']) ? $_POST['nohp'] : '';
$stnk = isset($_POST['stnk']) ? $_POST['stnk'] : '';
$merk = isset($_POST['merk']) ? $_POST['merk'] : '';
$plat = isset($_POST['plat']) ? $_POST['plat'] : '';
$warna = isset($_POST['warna']) ? $_POST['warna'] : '';
$jadwal = isset($_POST['jadwal']) ? $_POST['jadwal'] : '';
$lokasi_sidang = isset($_POST['lokasi_sidang']) ? $_POST['lokasi_sidang'] : '';
$tujuan = isset($_POST['tujuan']) ? $_POST['tujuan'] : '';
$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$id_tilang = isset($_POST['id_tilang']) ? $_POST['id_tilang'] : ''; // Ambil id_tilang dari request

// Pastikan id_tilang ada
if (empty($id_tilang)) {
    die("Error: id_tilang tidak ditemukan.");
}

// Ambil data denda dari tabel pasal
$sql = "SELECT * FROM tb_pelanggaran 
    JOIN pasal ON tb_pelanggaran.id_pasal = pasal.id_pasal 
    WHERE id_laporan = '$id_tilang'";
$result = $conn->query($sql);

// Debugging
if ($result === false) {
    die("Error: " . $conn->error);
}

$denda = '';
$pasal = '';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $denda .= "- " . $row['keterangan'] . "\n";
        $pasal .= "- " . $row['nama_pasal'] . "\n";
    }
} else {
    $denda = "Data denda tidak ditemukan.";
    $pasal = "Pasal tidak ditemukan.";
}

// Format pesan yang akan dikirim
$message = "Yth Bpk/Ibu Di Tempat \n" .
    "Pesan Ini Dikirim Oleh Satlantas Polres Parepare:\n" .
    "\n" .
    "Berikut Ini Detail Tilang Anda:\n" .
    "\n" .
    "Tanggal: $tgl\n" .
    "Nama Petugas: $nama_petugas\n" .
    "Nama Pelanggar: $nama_pelanggar\n" .
    "Alamat: $alamat\n" .
    "No HP: $nohp\n" .
    "NIK: $stnk\n" .
    "Merk: $merk\n" .
    "Plat: $plat\n" .
    "Warna: $warna\n";

if ($kategori == "Slip Merah") {
    $message .= "Pasal:\n".
        "$pasal" .
        "Kategori: $kategori\n" .
        "Jadwal Sidang: $jadwal\n" .
        "Lokasi Sidang: $lokasi_sidang\n" .
        "Status: $status\n";
} elseif ($kategori == "Slip Biru") {
    $message .= "Pasal:\n".
        "$pasal" .
        "Kategori: $kategori\n" .
        "Denda: \n".
        "$denda" .
        "Tujuan: $tujuan\n" .
        "Status: $status\n";
} 

// Token dan target nomor WhatsApp
$token = "V5EYmv+_JE1Y#mfL_2R+";
$target = $nohp; // Ganti dengan nomor tujuan

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.fonnte.com/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
    'target' => $target,
    'message' => $message,
  ),
  CURLOPT_HTTPHEADER => array(
    'Authorization: ' . $token
  ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
  $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
  echo $error_msg;
}
echo $response;

// Tutup koneksi database
$conn->close();
?>