<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
include 'path.php';

if(filesize($opPath."OPERATIONS.txt")!=0){

$han=fopen($opPath.'OPERATIONS.txt',"r");
$opr=fgets($han);
appendToTemp($opr);
deleteOperation($opr);
$oprs=explode(" ",$opr);
fclose($han);
$initialOff=$oprs[0];
$finalOff=$oprs[1];
$str=$oprs[2];
$ch=$oprs[3];
$han1=fopen($chPath.'ch-'.$ch,"r");
fseek($han1,$initialOff);
$sequence=fread($han1,($finalOff-$initialOff+1));
fclose($han1);
$finalData=$initialOff."#".$finalOff."#".$str."#".$ch."#".$sequence;
echo $finalData;


}else{
	echo 'not';
}

function appendToTemp($append){
	$chPath='chromosomes/';
$opPath='operations/';
	file_put_contents($opPath.'TEMPOPR.txt',$append,FILE_APPEND);
}


function deleteOperation($oper){
	$opPath='operations/';
$full=file_get_contents($opPath.'OPERATIONS.txt');
$newData=str_replace($oper,'',$full);
file_put_contents($opPath.'OPERATIONS.txt',$newData);
}



?>