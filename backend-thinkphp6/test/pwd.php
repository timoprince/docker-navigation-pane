<?php
$str = "123456";
$md5 = md5($str);
$hash_md5 = password_hash($md5, PASSWORD_DEFAULT);
var_dump($str);
var_dump($md5);
var_dump($hash_md5);