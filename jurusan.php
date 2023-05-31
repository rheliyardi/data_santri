<?php
// membuat instance
$dataJurusan=NEW jurusan;
// aksi tampil data
if($_GET['aksi']=='tampil'){
// aksi untuk tampil data
$html = null;
$html .='<h3>Kursus yang Dipilih</h3>';
$html .='<p>Berikut ini data jurusan rpl 3</p>';
$html .='<table border="1" width="100%">
<thead>
<th>No.</th>
<th>kode_Jurusan</th>
<th>nama_jurusan</th>
</thead>
<tbody>';
// variabel $data menyimpan hasil return
$data = $dataJurusan->tampil();
$no=null;
if(isset($data)){
foreach($data as $barisjurusan){
$no++;
$html .='<tr>
<td align="center">
   <img src="hadroh/<?php echo $row['cover']; ?>" width="60" height="80" />
</td>
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
$html .='<form method="POST"action="index.php?file=jurusan&aksi=simpan">';
$html .='<p>kode_jurusan<br/>';
$html .='<input type="text" name="txtkode_Jurusan"placeholder="Masukan No. Induk" autofocus/></p>';
$html .='<p>nama_jurusan <br/>';
$html .='<input type="text" name="txtnama_jurusan"placeholder="Masukan nama_jurusan Lengkap" size="30" required/></p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='simpan') {
$data=array(
'kode_Jurusan'=>$_POST['txtkode_Jurusan'],
'nama_jurusan'=>$_POST['txtnama_jurusan']
);
// simpan jurusan dengan menjalankan method simpan
$dataJurusan->simpan($data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=jurusan&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='edit') {
// ambil data jurusan
$jurusan=$dataJurusan->detail($_GET['kode_Jurusan']);
if($jurusan->kode_Jurusan_kelamin =='L') { $pilihL='checked';
$pilihP =null; }
else {
$pilihP='checked'; $pilihL =null; }
$html =null;
$html .='<h3>Form Tambah</h3>';
$html .='<p>Silahkan masukan form </p>';
$html .='<form method="POST"action="index.php?file=jurusan&aksi=update">';
$html .='<p>Nomor Induk jurusan<br/>';
$html .='<input type="text" name="txtkode_Jurusan"value="'.$jurusan->kode_Jurusan.'" placeholder="Masukan No. Induk"readonly/></p>';
$html .='<p>nama_jurusan Lengkap<br/>';
$html .='<input type="text" name="txtnama_jurusan"value="'.$jurusan->nama_jurusan.'" placeholder="Masukan nama_jurusan Lengkap"size="30" required autofocus/></p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='update') {
$data=array(
'nama_jurusan'=>$_POST['txtnama_jurusan']
);
$dataJurusan->update($_POST['txtkode_Jurusan'],$data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=jurusan&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='hapus') {
$dataJurusan->hapus($_GET['kode_Jurusan']);
echo '<meta http-equiv="refresh" content="0;url=index.php?file=jurusan&aksi=tampil">';
}
// aksi tidak terdaftar
else {
echo '<p>Error 404 : Halaman tidak ditemukan !</p>';
}
?>
