<!DOCTYPE html>
<html>
<body>

<?php
$txt = "PHP";

$txt = password_hash("123", PASSWORD_DEFAULT);


echo "I love $txt!" . PHP_EOL;

if( password_verify("123", $txt)){
    echo "FUNFOU";
}

else {
    echo "nÃO FUNFOU";
}
?>

</body>
</html>