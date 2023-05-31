<!DOCTYPE html>
<html lang="en">
<head>
<center><title>Data Santri</title></center>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include('class/Database.php');
include('class/Siswa.php');
include('class/Jurusan.php');
?>
<center><h1>Aplikasi Data Santri</h1></center>
<hr/>
<center><p> <nav>
   <ul>
<li><a href="index.php">Home</a></li>
<li><a href="index.php?file=siswa&aksi=tampil">Data Santri</a></li>
<li><a href="index.php?file=siswa&aksi=tambah">Tambah Data Santri</a></li>


</ul>
   </nav>
   


</p></center>
<hr/>
<button style="background-color:#7FFF00;" onclick="printFunction()">Print</button>

<script>
  function printFunction() { 
    window.print(); 
  }
</script>
<?php
if(isset($_GET['file'])){
include($_GET['file'].'.php');
} else {
echo '<h1 align="center"><img src="mondo.jpeg" /></h1>';

}
?>
</body>
</html>