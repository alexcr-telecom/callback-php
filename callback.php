<?php
$strhost = "127.0.0.1";
$strport = "5038";
$timeout = "10";
$num = $_POST['phone'];
$name = $_POST['name'];
$cid = $_POST['user'];
$c="a2billing";
$p="1";
$errno=0 ;
$errstr=0 ;
$sconn = fsockopen($strhost, $strport, $errno, $errstr, $timeout) or die("Connection to $strhost:$strport failed");
if (!$sconn) { echo "$errstr ($errno)<br>\n"; } 
else {
echo 'OK';
echo 'num-'.$num;
echo 'name-'.$name;
echo 'cid-'.$cid;

echo $_POST["name"];


fputs($sconn, "Action: login\r\n");
fputs($sconn, "Username: callback\r\n");
fputs($sconn, "Secret: mahapharata\r\n");
fputs($sconn, "Events: off\r\n\r\n");
usleep(500);
fputs($sconn, "Action: Originate\r\n");
fputs($sconn, "Channel: SIP/$cid\r\n");
fputs($sconn, "Callerid: $name\r\n");
fputs($sconn, "Timeout: 15000\r\n");
fputs($sconn, "Context: $c\r\n");
fputs($sconn, "Exten: $num\r\n");
fputs($sconn, "Priority: $p\r\n");
fputs($sconn, "Async: yes\r\n\r\n" );
fputs($sconn, "Action: Logoff\r\n\r\n");
usleep (500);
$wrets=fgets($sconn,128);
fclose($sconn);
exit; 
}
?>