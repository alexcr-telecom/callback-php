﻿jQuery(document).ready(function($) {
$("#contact").submit(function() {
var str = $(this).serialize();
var delay = 3000;
$.ajax({
type: "POST",
url: "http://192.168.1.2/callback/callback.php",
data: str,
success: function(msg) {
if(msg == 'OK') {
result = '<div class="notification_ok">Calling .... :)</div>';
} else {
result = msg;
}
$('#note').html(result);
}
});
return false;
});
});
