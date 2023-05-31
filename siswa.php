<?php
// membuat instance
$dataSiswa=NEW Siswa;
// aksi tampil data
if($_GET['aksi']=='tampil'){
// aksi untuk tampil data
$html = null;
$html .='<h3>Daftar Santri</h3>';
$html .='<p>Berikut ini data Santri </p>';
$html .='<table border="1" width="100%">
<thead>
<th>No.</th>
<th>No daftar</th>
<th>Nama</th>
<th>Tempat Lahir</th>
<th>Tanggal Lahir</th>
<th>L/P</th>
<th>Alamat</th>
<th>Kursus</th>
<th>aksi</th>
</thead>
<tbody>';
// variabel $data menyimpan hasil return
$data = $dataSiswa->tampil();
$no=null;
if(isset($data)){
foreach($data as $barisSiswa){
$no++;
$html .='<tr>
<td>'.$no.'</td>
<td>'.$barisSiswa->nis.'</td>
<td>'.$barisSiswa->nama.'</td>
<td>'.$barisSiswa->tempat_lahir.'</td>
<td>'.$barisSiswa->tanggal_lahir.'</td>
<td>'.$barisSiswa->jenis_kelamin.'</td>
<td>'.$barisSiswa->alamat.'</td>
<td>'.$barisSiswa->kursus.'</td>
<td>
<a href="index.php?file=siswa&aksi=edit&nis='.$barisSiswa->nis.'">Edit</a>
<a href="index.php?file=siswa&aksi=hapus&nis='.$barisSiswa->nis.'">Hapus</a>
</td>
</tr>';
}
}
$html .='</tbody>
</table>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='tambah') {
$html =null;
$html .='<h3>Form Tambah</h3>';
$html .='<p>Silahkan masukan form </p>';
$html .='<form method="POST"action="index.php?file=siswa&aksi=simpan">';
$html .='<p>Nomor Daftar<br/>';
$html .='<input type="text" name="txtNis"placeholder="Nomor Daftar Santri" autofocus/></p>';
$html .='<p>Nama Lengkap<br/>';
$html .='<input type="text" name="txtNama"placeholder="Masukan Nama Lengkap" size="30" required/></p>';
$html .='<p>Tempat, Tanggal Lahir<br/>';
$html .='<input type="text" name="txtTempatLahir"placeholder="Masukan Tempat Lahir" size="30" required/>,';
$html .='<input type="date" name="txtTanggalLahir"required/></p>';
$html .='<p>Jenis Kelamin<br/>';
$html .='<input type="radio" name="txtJenisKelamin"value="L"> Laki-laki';
$html .='<input type="radio" name="txtJenisKelamin"value="P"> Perempuan</p>';
$html .='<p>Alamat<br/>';
$html .='<textarea name="txtAlamat" placeholder="Masukan alamat lengkap" cols="50" rows="5" required></textarea></p>';
$html .='<p>kursus<br/>';
$html .='<input type="radio" name="kursus"value="Tahfidz">Tahfidz';
$html .='<input type="radio" name="kursus"value="MTQ">MTQ</p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='simpan') {
$data=array(
'nis'=>$_POST['txtNis'],
'nama'=>$_POST['txtNama'],
'tempat_lahir'=>$_POST['txtTempatLahir'],
'tanggal_lahir'=>$_POST['txtTanggalLahir'],
'jenis_kelamin'=>$_POST['txtJenisKelamin'],
'alamat'=>$_POST['txtAlamat'],
'kursus'=>$_POST['kursus']

);
// simpan siswa dengan menjalankan method simpan
$dataSiswa->simpan($data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=siswa&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='edit') {
// ambil data siswa
$siswa=$dataSiswa->detail($_GET['nis']);
if($siswa->jenis_kelamin =='L') { $pilihL='checked';
$pilihP =null; }
else {
$pilihP='checked'; $pilihL =null; }
if($siswa->kursus =='Tahfidz') { $pilihTahfidz='checked';
    $pilihMTQ =null; }

    else{
        $pilihMTQ='checked'; $pilihTahfidz =null; }
$html =null;
$html .='<h3>Form Tambah</h3>';
$html .='<p>Silahkan masukan form </p>';
$html .='<form method="POST"action="index.php?file=siswa&aksi=update">';
$html .='<p>Nomor Daftar<br/>';
$html .='<input type="text" name="txtNis"value="'.$siswa->nis.'" placeholder="Masukan No. Induk"readonly/></p>';
$html .='<p>Nama Lengkap<br/>';
$html .='<input type="text" name="txtNama"value="'.$siswa->nama.'" placeholder="Masukan Nama Lengkap"size="30" required autofocus/></p>';
$html .='<p>Tempat, Tanggal Lahir<br/>';
$html .='<input type="text" name="txtTempatLahir"value="'.$siswa->tempat_lahir .'" placeholder="Masukan TempatLahir" size="30" required/></p>,';
$html .='<input type="date" name="txtTanggalLahir"value="'.$siswa->tanggal_lahir.'" required/></p>';
$html .='<p>Jenis Kelamin<br/>';
$html .='<input type="radio" name="txtJenisKelamin"value="L" '.$pilihL.'> Laki-laki';
$html .='<input type="radio" name="txtJenisKelamin"value="P" '.$pilihP.'> Perempuan</p>';
$html .='<p>Alamat<br/>';
$html .='<textarea name="txtAlamat" placeholder="Masukan alamat lengkap" cols="50" rows="5"required>'.$siswa->alamat.'</textarea></p>';
$html .='<p>kursus<br/>';
$html .='<input type="radio" name="kursus"value="Tahfidz"'.$pilihTahfidz.'>Tahfidz';

$html .='<input type="radio" name="kursus"value="MTQ" '.$pilihMTQ.'>MTQ</p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='update') {
$data=array(
'nama'=>$_POST['txtNama'],
'tempat_lahir'=>$_POST['txtTempatLahir'],
'tanggal_lahir'=>$_POST['txtTanggalLahir'],
'jenis_kelamin'=>$_POST['txtJenisKelamin'],
'alamat'=>$_POST['txtAlamat'],
'kursus'=>$_POST['kursus']
);
$dataSiswa->update($_POST['txtNis'],$data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=siswa&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='hapus') {
    $dataSiswa->hapus($_GET['nis']);
    $sql_delete="DELETE FROM siswa WHERE nis='$nis'";

    mysqli_query($koneksi,$sql_delete);
    
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=siswa&aksi=tampil">';
}
// aksi tidak terdaftar
else {
    echo ' <p>Error 404 : halaman tidak ditemukan !</p>';
}
?>
