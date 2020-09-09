<?php include 'db.php';
$sms;
// Указываем кодировку, в которой будет получена информация из базы
@mysqli_query ($db, 'set character_set_results = "utf8"');

// Получаем IP-адрес посетителя и сохраняем текущую дату
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d");

// Узнаем, были ли посещения за сегодня
$res = mysqli_query($db, "SELECT `visit_id` FROM `visits` WHERE `date`='$date'") or die ("Проблема при подключении к БД");

// Если сегодня еще не было посещений
if (mysqli_num_rows($res) == 0)
{
    // Очищаем таблицу ips
    mysqli_query($db, "DELETE FROM `ips`");

    // Заносим в базу IP-адрес текущего посетителя
    mysqli_query($db, "INSERT INTO `ips` SET `ip_address`='$visitor_ip'");

    // Заносим в базу дату посещения и устанавливаем кол-во просмотров и уник. посещений в значение 1
    $res_count = mysqli_query($db, "INSERT INTO `visits` SET `date`='$date', `hosts`=1,`views`=1");
}

// Если посещения сегодня уже были
else
{
    // Проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
    $current_ip = mysqli_query($db, "SELECT `ip_id` FROM `ips` WHERE `ip_address`='$visitor_ip'");

    // Если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель)
    if (mysqli_num_rows($current_ip) == 1)
    {
        // Добавляем для текущей даты +1 просмотр (хит)
        mysqli_query($db, "UPDATE `visits` SET `views`=`views`+1 WHERE `date`='$date'");
    }

    // Если сегодня такого IP-адреса еще не было (т.е. это уникальный посетитель)
    else
    {
        // Заносим в базу IP-адрес этого посетителя
        mysqli_query($db, "INSERT INTO `ips` SET `ip_address`='$visitor_ip'");

        // Добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
        mysqli_query($db, "UPDATE `visits` SET `hosts`=`hosts`+1,`views`=`views`+1 WHERE `date`='$date'");
    }
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<link href="https://bootstraptema.ru/snippets/generator/2015/jquery-ui-git.css" rel="stylesheet" />
<link href="https://bootstraptema.ru/snippets/generator/2015/jquery.colorpicker.css" rel="stylesheet" />
<script type="text/javascript" src="https://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>

<style>
.col-md-3 {text-align:center;margin-bottom:5px}.col-md-3 i {width:100%;float:left;font-size:44px}.text-shadow-code, .option-text-shadow { position:relative; padding:45px 15px 15px; margin:0 -15px 15px; background-color:#fafafa; box-shadow:inset 0 3px 6px rgba(0,0,0,.05); border-color:#e5e5e5 #eee #eee; border-style:solid; border-width:1px 0;}.text-shadow-code:after{ content:"Готовый код тени"; position:absolute; top:15px; left:15px; font-size:12px; font-weight:700; color:#bbb; text-transform:uppercase; letter-spacing:1px;}.option-text-shadow:after{ content:"Настройка тени"; position:absolute; top:15px; left:15px; font-size:12px; font-weight:700; color:#bbb; text-transform:uppercase; letter-spacing:1px;}.text-shadow-code+pre, .option-text-shadow+fieldset { margin:-15px -15px 15px; border-radius:0; border-width:0 0 1px;}@media (min-width:768px){.text-shadow-code, .option-text-shadow{ margin-left:0; margin-right:0; background-color:#fff; border-width:1px; border-color:#ddd; border-radius:4px 4px 0 0; box-shadow:none;}}
</style>

<style>
h3,h2,h4{font-family: 'KarollaC';}

.sh{
  
 color: black;
 -webkit-text-stroke: 1px black;
 -webkit-text-fill-color: white;

}
.fn{
font-family: 'KarollaC';    
}
@font-face {
font-family: 'KarollaC';
src: url('https://bootstraptema.ru/snippets/font/2016/karollac/KarollaC.otf');

}
.sh-wrong{
  
 color: black;
 -webkit-text-stroke: 1px black;
 -webkit-text-fill-color: #FF4645;

}
.sh-success{
  
 color: black;
 -webkit-text-stroke: 1px black;
 -webkit-text-fill-color: #27D658;

}

    body {
    background: linear-gradient(to bottom, #33ccff 0%, #ffff66 100%);
}
</style>
<script>
var check =false;
   function buttoncreate() {
    if(check==false){
    document.getElementById("show").style.display = "block";
    this.check = true;
   }else{
    document.getElementById("show").style.display = "none";
    this.check = false;
   }

   }

</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body>
    <div class="container" style="text-align:center;">
        <div class="main" style="margin-top:45%;">
<?php
 $data=$_POST;
 if(isset($_POST["text1"])){
$text1 =  $_POST["text1"];
}
    if(isset($_POST["name1"])){
$name1 =  $_POST["name1"];
}     
         $date1 = date('Y-m-d H:i:s');
    if(isset($data['sab'])){
<<<<<<< HEAD
        if($name1!=''){
        	if($text1!=''){
=======
        if($text1!=''&&$name1!=''){
>>>>>>> 25fb776c22158844ceedeaecfc2e3b58522a66f6
            mysqli_query($db, "INSERT INTO `massages` (`name`, `data`, `massage`) VALUES ('$name1', '$date1', '$text1');");
                echo '<br><div class="fn sh-success" style="color:#27D658;font-size:700%">Ваш вопрос отправлен.<br>Илья уже увидел его!</div>';
              
                }else{
                	echo '<br><div class="fn sh-wrong" style="font-size:700%">Введите свое имя!</div>';
                }
<<<<<<< HEAD
            }else{
 				echo '<br><div class="fn sh-wrong" style="font-size:700%">Введите свой вопрос!</div>';
            }
=======

>>>>>>> 25fb776c22158844ceedeaecfc2e3b58522a66f6
        }
   
?>
            <s></s><h3 style="font-size:1000%;color:white;"><span class="sh">Вы попали на супер функциональный сайт от гуру кодинга!<span></span></h3></s><br><br><br>
    
<input  style="font-size:900%" type="button" value="Задать вопрос" class="btn btn-info fn sh" onclick="buttoncreate()" id="button2" style="border:2px solid green"/><br><br><br><br>
<div id="show" style="display:none;text-align:center;">
    <form action="index.php" method="POST">
      <h4 style="font-size:800%;color:white;" class="fn sh">Имя(Анонимно)</h4>
      <input style="font-size:800%" type="text" name="name1" placeholder="Напиши свое имя" class="fn sh">
      <h4 style="font-size:800%;color:white;" class="fn sh">Вопрос</h4>
      <input style="font-size:800%" type="text" name="text1" placeholder="Напиши вопрос" style="width:40%;height:60%;" class="fn sh"><br><br>
      	<input  style="font-size:800%" class="btn btn-info fn sh" type="submit" value="Отправить" name="sab" required="required">
      
    </form>
	
        
</div>
        </div>
    </div>
    
</body>
