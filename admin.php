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
<div class="container jumbotron" style="margin-top:5%;font-size:250%;text-align:center">
    <h1 style="font-size:200%;">Ваш логин: <?php echo $_SESSION['logged_user']?></h1>
 
    <hr>

     <a class="btn btn-info fn" href="stats-today.php?interval=1" style="font-size:150%;">Статистика за сегодня </a>
  <br><br>
      <a class="btn btn-info fn" href="stats-all.php?interval=351" style="font-size:150%;">Статистика за все время </a>
   <br><br>
      <a class="btn btn-info fn" href="questions.php" style="font-size:150%;">Вопросы</a>
   <br><br>
      <a class="btn btn-info fn" href="admin-list.php" style="font-size:150%;">Список админов</a>
      <br><br>
       <a class="btn btn-success fn" href="index.php" style="font-size:150%;">Главная</a>
  <br><br>
     
      <a class="btn btn-danger fn" href="logout.php" style="font-size:150%;">Выйти</a>
  
  </div>
  	<?php else :  ;?>
  	<div class="container jumbotron" style="margin-top:5%;font-size:250%;text-align:center">
    <h1 style="font-size:300%;">Админ панель</h1>
    <hr>
  <form action="admin.php" method="POST">
      <h4 style="font-size:200%;color:white;">Логин</h4>
      <input type="text" name="name" placeholder="Логин">
      <h4 style="font-size:200%;color:white;">Пароль</h4>
      <input type="password" name="ps" placeholder="Пароль"><br><br>
      	<input style="font-size:200%;" class="btn btn-info" type="submit" value="Войти" name="sab" required="required">
      	<?php
//login here


$data = $_POST;
if(isset($_POST['name'])){
   $name1=$_POST['name'];
   $sql = "SELECT * FROM `users` WHERE `name`='$name1'";
   $result = mysqli_query($db, $sql);
   $row = mysqli_fetch_assoc($result);
   $current_name = mysqli_query($db, "SELECT `name` FROM `users` WHERE `name`='$name1'");
}
if(isset($_POST['ps'])){
   $ps1=$_POST['ps'];
}
if(isset($data['sab'])){
    if($name1!=''){
        if($ps1!=''){
            if(mysqli_num_rows($current_name)==1){
                if($row['password']==$ps1){
                    //login
                    echo '<script>window.location.href = "admin.php";</script>';
			        $_SESSION['logged_user'] = $row['name'];
                 }else{
                     echo '<p style="color:red">Пароль не верный</p>';
                 }
            }else{
              echo '<p style="color:red">Такого пользователя не существует!</p>';  
            }
        }else{
        echo '<p style="color:red">Заполни поле для пароля</p>';
    }
    }else{
        echo '<p style="color:red">Заполни поле для имени</p>';
    }
}
?>
    </form>
  
  </div>
  <?php endif; ?>
</body>