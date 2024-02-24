<?php
    error_reporting(0);
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
	
	$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Galeri Foto  </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">GALERI FOTO  </a></h1>
        <ul>
            <li><a href="galeri.php">Galeri</a></li>
           <li><a href="registrasi.php">Registrasi</a></li>
           <li><a href="login.php">Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>
    
    <!-- product detail -->
    <div class="section">
        <div class="container">
             <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                   <img src="foto/<?php echo $p->image ?>" width="100%" /> 
                </div>
                <div class="col-2">
                   <h3><?php echo $p->image_name ?><br />Kategori : <?php echo $p->category_name  ?></h3>
                   <h4>Nama User : <?php echo $p->admin_name ?><br />
                   Upload Pada Tanggal : <?php echo $p->date_created  ?></h4>
                   <p>Deskripsi :<br />
                        <?php echo $p->image_description ?>
                        <div class='lovebutton-bloggerku' expr:data-id='data:blog.blogId + &quot;_&quot; + data:post.id'>
                        
                <div class="col-2">

                <from method="POST">
                
           <input type="text" name="adminid" value="<?php echo $_SESSION ['a_global']->admin_id ?>" readonly>
           <input type="text" name="image_id" value="<?php echo $p->image_id ?>" readonly>
           <input type="date" name="TanggalKomentar" value="<?php echo date('Y-m-d') ?>" readonly>
           <!-- <input type="text" name="adminid" value="<?php echo $_SESSION ['a_global']->admin_id ?>" class="btn"> -->
              <textarea type="text" name="IsiKomentar" class="input-control" maxlength="300" placeholder="Tulis Komentar...." required></textarea>
              <button type="submit" name="submit" value="submit" class="btn btn-primary">kirim</button>
           </from>
           <?php 

if(isset($_POST['submit'])){   
$tambah = mysqli_query($conn, "INSERT INTO komentarfoto VALUES ('',".$_POST['adminid'].",".$_POST['image_id'].",".$_POST['TanggalKomentar'].",".$_POST['IsiKomentar'].")");

if($tambah){
							echo '<script>alert("Registrasi berhasil")</script>';
							echo '<script>window.location="index.php"</script>';
						}else{
						    echo 'gagal '.mysqli_error($conn);
						}
						
					   }
                       ?>
                </div>
<div class="col-7">
<!--suka-->
<from method="POST";
<?php
$qt = mysqli_query($conn, "SELECT SUM(suka) FROM tb_likefoto WHERE image_id ='".$_GET('id')."' ");
if(mysqli_num_rows($qt) > 0) {
    while($qt = mysqli_fetch_array($qt)){
        ?>
        <button name="suka" class="like">like <?php echo $qt['SUM(suka)'] ?> </button><br />
        <?php }}else{?>
             <p>tidak ada like</p>
        <?php } ?>
        </from>

        <?php
        if(isset($_POST['suka'])){
            include 'db.php';
            echo '<srcript>window.location="login.php</script>';
        }?><br />

        <div class="content"></div>
            <form action=""method="POST">
            <input type="hidden" name="adminid" value="<?php echo $_SESSION ['a_global']->admin_id ?>">
            <input type="submit" name="UserID" value="kirim" class="btn-primary">
             <textarea type="text" name="komentar" class="input-control" maxlegth="300"placeholder="Tulis komentar..."required></textarea>
             <input type="submit" name="submit" value="kirim" class="btn">
        </from>
    <?php
    if(isset($_POST['submit'])){
                                     
                                     echo '<script>alert("Login Terlebih Dahulu")</script>';
                                     echo '<script>window.location="login.php"</script>';

    }


?>


<br />
<div class="">