<?php
$username=trim($_POST['user']);
$password=md5(trim($_POST['pass']));
$email=trim($_POST['email']);
$mobile=trim($_POST['mobile']);
$arr=array("user"=>$username,"password"=>$password,"email"=>$email,"mobile"=>$mobile);
//使用dom
$dom=new DomDocument("1.0","utf-8");//开头的申明
$root=$dom->createElement("root");
$dom->appendChild($root);
$username=$dom->createElement("username");
foreach($arr as $key=>$vol)
{
	$keys=$dom->createElement("$key");
	$text=$dom->createTextNode("$vol");
	$keys->appendChild($text);
	$username->appendChild($keys);
}
$root->appendChild($username);
$file="user.xml";
$dom->save($file);
if(is_file($file)==true)
{
	echo 1;
}
else
{
	echo 0;
}
