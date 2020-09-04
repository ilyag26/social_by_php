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
    <!--<div class="row">-->
    <!--    <div class="col-3">-->
    <!--       <a class="btn btn-info" href="admin.php" style="font-size:100%;">Назад</a> -->
    <!--    </div>-->
    <!--        <div class="col-5">-->
    <!--        <h1 style="font-size:200%;margin-bottom:50px;">Вопросы: </h1>-->
    <!--    </div>-->
    <!--</div>-->
   
     <form action="questions.php" method="POST">
          <a class="btn btn-info fn" href="admin.php" style="font-size:150%;">Назад</a>
        <input type="submit" name="delete" value="Удалить все" class="btn btn-danger" style="font-size:100%;"></form>
    <?php
    if(isset($_POST['login'])){
   $login=$_POST['login'];
}
       $data = $_POST;
         if(isset($data['delete'])){
             mysqli_query($db, "DELETE FROM `massages`");
             echo '<script>window.location.href = "questions.php";</script>';
             
         }?>
    <h1 style="font-size:200%;margin-bottom:50px;">Вопросы: </h1>
    <hr>
    
<?php

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `massages` ORDER BY `id` DESC";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         echo '<span class="fn">Вопрос от</span> <b class="fn">'.$row['name'].'</b> | <span class="fn">Дата:</span> <i class="fn"><b>' . $row['data'] .'</b></i>
         <p class="fn">'.$row['massage'].'</p><hr>';
        }
    } else {
    echo '<p class="fn">Тут еще нет вопросов</p>';
}
mysqli_close($db);
?>
</div>
<?php else :  ;?>
<?php echo '<script>window.location.href = "admin.php";</script>';?>
<?php endif; ?>
</body>