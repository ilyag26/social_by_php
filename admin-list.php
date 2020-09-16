<?php include( "db.php") ?>

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
    <form action="admin-list.php" method="POST">
        <input type="text" name="login" style="font-size:100%;" placeholder="Введите логин админа">
        <input type="submit" name="delete" value="Удалить" class="btn btn-danger" style="font-size:100%;"></form>
    <?php
    if(isset($_POST['login'])){
   $login=$_POST['login'];
   $current_login = mysqli_query($db, "SELECT `name` FROM `users` WHERE `name`='$login'");
}
       $data = $_POST;
         if(isset($data['delete'])){
             if(mysqli_num_rows($current_login)==1){
             mysqli_query($db, "DELETE FROM `users` WHERE `name`='$login'");
             echo '<script>window.location.href = "admin-list.php";</script>';
             if($login==$_SESSION['logged_user']){
                 unset($_SESSION['logged_user']);
             }
             }else{
                 echo '<p style="color:#BD2D2D;">Такого админа не существует!</p>';
             }
         }?>
         <hr>
             <form action="admin-list.php" method="POST">
      <input type="text" name="name" style="font-size:100%;" placeholder="Логин">
      <input type="password" name="ps" style="font-size:100%;" placeholder="Пароль"><br><br>
      	<input type="submit" class="btn btn-success" value="Добавить" style="font-size:100%;" name="sab" required="required">
</form>
<?php
$data=$_POST;
if(isset($_POST['name'])){
   $name1=$_POST['name'];
   $current_name = mysqli_query($db, "SELECT `name` FROM `users` WHERE `name`='$name1'");
}
if(isset($_POST['ps'])){
   $ps1=$_POST['ps'];
}
$date1=date('Y-m-d H:i:s');
if(isset($data['sab'])){
    
    if($name1!=''){
        if($ps1!=''){
            if(mysqli_num_rows($current_name)!=1){
                mysqli_query($db, "INSERT INTO `users` (`name`, `password`, `date`, `access`) VALUES ('$name1', '$ps1', '$date1', '0')");
                echo '<p style="color:green">Админ успешно добавлен!</p>';
                echo '<script>window.location.href = "admin-list.php";</script>';
                  
            }else{
              echo '<p style="color:#BD2D2D">Такой админ уже существует!</p>';  
            }
        }else{
        echo '<p style="color:#BD2D2D">Заполни поле для пароля</p>';
    }
    }else{
        echo '<p style="color:#BD2D2D">Заполни поле для имени</p>';
    }
}
?>
<hr>
             <form action="admin-list.php" method="POST">
      <input type="text" name="name3" style="font-size:100%;" placeholder="Логин">
      <input type="text" name="status" style="font-size:100%;" placeholder="Статус админа"><br><br>
      	<input type="submit" class="btn btn-success" value="Изменить статус админа" style="font-size:100%;background-color:#A82DBD;" name="status-update" required="required">
</form>
<?php
     $login3 = $_SESSION['logged_user'];
     $data=$_POST;
     $current_status = mysqli_query($db, "SELECT * FROM `users` WHERE `name`='$login3'");
     $row = mysqli_fetch_assoc($current_status);
     $status_check = $row['access'];
if(isset($_POST['name3'])){
   $name3=$_POST['name3'];
   $current_name_status = mysqli_query($db, "SELECT `name` FROM `users` WHERE `name`='$name3'");
}
if(isset($_POST['status'])){
   $status=$_POST['status'];
}
   

if(isset($data['status-update'])){

if($status_check>=2){
    if($name3!=''){
        if($status!=''){
            if(mysqli_num_rows($current_name_status)==1){
                mysqli_query($db, "UPDATE `users` SET `access` = '$status' WHERE `name` = '$name3';");
                echo '<p style="color:green">Статус успешно изменен!</p>';
                echo '<script>window.location.href = "admin-list.php";</script>';
            }else{
              echo '<p style="color:#BD2D2D">Такого админа не существует!</p>';  
            }
        }else{
        echo '<p style="color:#BD2D2D">Заполни поле для статуса</p>';
    }
    }else{
        echo '<p style="color:#BD2D2D">Заполни поле для имени</p>';
    }   
}else{
    echo '<p style="color:#BD2D2D">Чтоб изменить статус админа у вас должен быть статус больше 2</p>';
}
}
?>
    <hr>
    <h1 style="font-size:200%;margin-bottom:50px;">Админы: </h1>
<?php
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM `users`";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         echo '<span class="fn">Логин: </span> <b class="fn">'.$row['name'].'</b> |<span class="fn">Статус:</span> <b class="fn">'.$row['access'].'</b> | <span class="fn">Дата регестрации: </span> <i class="fn"><b> ' . $row['date'] .'</b></i>
         <hr>';
        }
    } else {
    echo '<p class="fn">Админов нет</p>';
}
mysqli_close($db);
?>
</div>
<?php else :  ;?>
<?php echo '<script>window.location.href = "admin.php";</script>';?>
<?php endif; ?>
</body>