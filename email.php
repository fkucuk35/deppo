<?php

require "libs/functions.php";
$result = sendEmail('fatihkucuk@live.com', 'Test Email', 'HTML message body in <b>bold</b> ', 'Body in plain text for non-HTML mail clients');
if($result["success"]){
    echo "Mail başarıyla gönderildi...";
}
else
{
    echo "Mail gönderimi sırasında hata oluştu.<br>Hata: ".$result["msg"];
}
?>