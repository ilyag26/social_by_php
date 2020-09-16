<?php include( "db.php") ?>
<?php
     $server = 'localhost';
     $username = 'id14761683_ilyagaiv';
     $password = '!!Javacool01';
     $dbname = 'id14761683_users';
     $charset = 'utf8';
     $connection = new mysqli($server,$username, $password, $dbname);

if($connection->connect_error){
	die("Ошибка соединения".$connection->connect_error);
}

if(!$connection->set_charset($charset)){
	echo "Ошибка установки кодировки UTF8";
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>
    body {
    background: linear-gradient(to bottom, #33ccff 0%, #ffff66 100%);
    color:white;
}
.jumbotron{
    background-color:#008AC6;
}
hr{
  background-color:#fff;  
}
</style>
<body>
    <?php if(isset($_SESSION['logged_user'])) :	?>
<div class="container jumbotron" style="margin-top:5%;font-size:250%;">

    <a class="btn btn-info fn" href="admin.php" style="font-size:150%;">Назад</a>
    <h1 style="font-size:200%;margin-bottom:50px;">Добавление продукта: </h1>
 
             <form action="add-product.php" method="post" enctype="multipart/form-data">
                  <input type="text" name="product_name" style="font-size:100%;" placeholder="Название продукта"><br><br>
      <input type="text" name="description" style="font-size:100%;" placeholder="описание"><br><br>
<input type="file"  name="img_upload"><br><br>
<input type="submit" class="btn btn-info" name="upload" style="font-size:100%;" value="Загрузить"><br>
<?php
	 $data=$_POST;
	 $date1=date('Y-m-d H:i:s');
     $login_name = $_SESSION['logged_user'];
     $current_status = mysqli_query($db, "SELECT * FROM `users` WHERE `name`='$login_name'");
     $row2 = mysqli_fetch_assoc($current_status);
     $status_check = $row2['access'];
     if(isset($_POST['product_name'])){
   $product_name=$_POST['product_name'];
}
if(isset($_POST['description'])){
   $description=$_POST['description'];
}
  
if(isset($_POST['upload'])){
    if($status_check!=0){
        if($product_name!=''){
            if($description!=''){  
                	$img_type = substr($_FILES['img_upload']['type'], 0, 5);
	$img_size = 2*1024*1024;
	if(!empty($_FILES['img_upload']['tmp_name'])){ 
	    $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
	               mysqli_query($db, "INSERT INTO `products` (`productname`, `date`,`name`,`description`,`img`) VALUES ('$product_name', '$date1', '$login_name','$description','$img')");
	               echo '<p style="color:green;">Продукт успешно загружен!</p>';
	                }else{
	                    echo '<p style="color:#BD2D2D;">Ошибка!</p>';
	                }
            }else{
                echo '<p style="color:#BD2D2D;">Напишите описание к продукту!</p>';
            }
        }else{
         echo '<p style="color:#BD2D2D;">Введите название продукта</p>';
        }
    }else{
        echo '<p style="color:#BD2D2D;">Вам не разрешено выкладывать посты!</p>';
    }
}
?>
</form>
<?php
// 	$sql = "SELECT * FROM products ORDER BY id DESC";
// $result = mysqli_query($db, $sql);
// 	while($row = mysqli_fetch_assoc($result)){
// 		$show_img = $row['img'];?>
		<!--<img src="data:image/jpeg;base64, <?=$show_img ?>" alt="">-->
	<?php //} ?>
</form>
</div>
<?php else :  ;?>
<?php echo '<script>window.location.href = "admin.php";</script>';?>
<?php endif; ?>
</body>