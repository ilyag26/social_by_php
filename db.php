<?php
// Хост (обычно localhost)
$db_host = "localhost";
// Имя базы данных
$db_name = "id14761683_users";
// Логин для подключения к базе данных
$db_user = "id14761683_ilyagaiv";
// Пароль для подключения к базе данных
$db_pass = "!!Javacool01";

$db = mysqli_connect ($db_host, $db_user,$db_pass, $db_name) or die ("Невозможно подключиться к БД");
session_start();