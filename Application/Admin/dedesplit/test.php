<?
require("lib_splitword_full.php");

$str = "
 ǳ���ҹ�����������ģʽǰ��
";


$t1 = ExecTime();

$sp = new SplitWord();

$t2 = ExecTime();

//$t0 = $t2-$t1;

//echo "����ʱ�䣺 $t0 <br><br>";


//echo $sp->FindNewWord($sp->SplitRMM($str))."<hr>";
echo $sp->SplitRMM($str)."<hr>";

$sp->Clear();

echo $str."<br>";

$t3 = ExecTime();
$t0 = $t3-$t2;
echo "<br>����ʱ�䣺 $t0 <br><br>";


function ExecTime(){ 
	$time = explode(" ", microtime());
	$usec = (double)$time[0]; 
	$sec = (double)$time[1]; 
	return $sec + $usec; 
}
?>