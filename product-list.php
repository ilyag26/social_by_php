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

    <a class="btn btn-info fn" href="admin.php" style="font-size:150%;">Назад</a><br><br>
              <form action="product-list.php" method="POST">
        <input type="text" name="id" style="font-size:100%;" placeholder="Введите id">
        <input type="submit" name="delete" value="Удалить" class="btn btn-danger" style="font-size:100%;"></form>
         <?php
    if(isset($_POST['id'])){
   $id=$_POST['id'];
   $current_login = mysqli_query($db, "SELECT `id` FROM `products` WHERE `id`='$id'");
}
       $data = $_POST;
         if(isset($data['delete'])){
             if(mysqli_num_rows($current_login)==1){
             mysqli_query($db, "DELETE FROM `products` WHERE `id`='$id'");
             echo '<script>window.location.href = "product-list.php";</script>';
             if($login==$_SESSION['logged_user']){
                 unset($_SESSION['logged_user']);
             }
             }else{
                 echo '<p style="color:#BD2D2D;">Такого пользователя не существует!</p>';
             }
         }?>
         <h1 style="font-size:200%;margin-bottom:50px;">Продукты: </h1>
<?php
	$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($db, $sql);
	while($row = mysqli_fetch_assoc($result)){
 	$show_img = base64_encode($row['img']);
 	
 	echo '<span>Id: <b>'.$row['id'].'</b> </span><br><span>Автор: <i>'.$row['name'].'</i></span><br><span>Дата: <i>'.$row['date'].'</span></i><br><span>Название товара: <i>'.$row['productname'].'</i></span><br><span>Описание товара: <i>'.$row['description'].'</i></span><br>';
 	?>
 	
		<img src="data:image/jpeg;base64, <?=$show_img ?>" alt="" style="width:50%;height:50%;"><br><hr>
	<?php } ?>
</form>
 
</div>

<?php else :  ;?>
<?php echo '<script>window.location.href = "admin.php";</script>';?>
<?php endif; ?>
</body>