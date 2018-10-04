<?php
$strhost = "127.0.0.1";
$strport = "5038";
$timeout = "10";
$num = $_POST['phone'];
$callerid = $_POST['callerid'];
$user = $_POST['user'];
$c="from-internal";
$p="1";
$errno=0 ;
$errstr=0 ;
$sconn = fsockopen($strhost, $strport, $errno, $errstr, $timeout) or die("Connection to $strhost:$strport failed");
if (!$sconn) { echo "$errstr ($errno)<br>\n"; } 
else {
echo 'OK';
//echo 'num-'.$num;
//echo 'name-'.$name;
//echo 'cid-'.$cid;

fputs($sconn, "Action: login\r\n");
fputs($sconn, "Username: callback\r\n");
fputs($sconn, "Secret: mysuperpass\r\n");
fputs($sconn, "Events: off\r\n\r\n");
usleep(500);
fputs($sconn, "Action: Originate\r\n");
fputs($sconn, "Channel: SIP/$user\r\n");
fputs($sconn, "Callerid: $callerid\r\n");
fputs($sconn, "Timeout: 15000\r\n");
fputs($sconn, "Context: $c\r\n");
fputs($sconn, "Exten: $num\r\n");
fputs($sconn, "Priority: $p\r\n");
fputs($sconn, "Async: yes\r\n" );
fputs($sconn, "Variable: MYCALLERID=$callerid\r\n\r\n" );
fputs($sconn, "Action: Logoff\r\n\r\n");
usleep (500);
$wrets=fgets($sconn,128);
fclose($sconn);
exit; 
}
?>
