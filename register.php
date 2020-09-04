<?php include('db.php');?>
    <form action="register.php" method="POST">
      <h4>Имя</h4>
      <input type="text" name="name" placeholder="Напиши свое имя">
      <h4 >Пароль</h4>
      <input type="password" name="ps" placeholder="Напиши вопрос"><br><br>
      	<input type="submit" value="Создать" name="sab" required="required">
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
                mysqli_query($db, "INSERT INTO `users` (`name`, `password`, `date`) VALUES ('$name1', '$ps1', '$date1')");
                echo '<p style="color:green">Пользователь успешно создан!</p>';  
            }else{
              echo '<p style="color:red">Такой пользователь уже существует!</p>';  
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
