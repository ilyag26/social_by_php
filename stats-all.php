<?php include( "db.php");
$date1 = date('Y-m-d');
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
<a class="btn btn-info" href="admin.php" style="font-size:150%;">Назад</a>
<h2 style="font-size:200%;">Статистика за все время</h2><hr>


<?php
// Если в массиве GET есть элемент interval (т.е. был клик по одной из ссылок выше)
if ($_GET['interval'])
{
	$interval = $_GET['interval'];

    // Если в качестве параметра передано не число
    if (!is_numeric ($interval))
    {
        echo '<p><b>Недопустимый параметр!</b></p>';
    }

    // Указываем кодировку, в которой будет получена информация из базы
    @mysqli_query ($db, 'set character_set_results = "utf8"');

    // Получаем из базы данные, отсортировав их по дате в обратном порядке в количестве interval штук
	$res = mysqli_query($db, "SELECT * FROM `visits` ORDER BY `date` DESC LIMIT $interval");

    // Формируем вывод строк таблицы в цикле
	while ($row = mysqli_fetch_assoc($res))
    {
		echo    '<span><b>Дата: </b>' . $row['date'] . '</span><br>
			     <span><b>Уникальные посищения: </b>' . $row['hosts'] . '</span><br>
			     <span><b>Просмотры: </b>' . $row['views'] . '</span><hr>';
	}
}
?>
</div>
<?php else :  ;?>
<?php echo '<script>window.location.href = "admin.php";</script>';?>
<?php endif; ?>
</body>