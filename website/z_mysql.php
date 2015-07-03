<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="my keywords" />
        <meta name="description" content="my description" />
        <title>
            my title
        </title>
    </head>
    </script>
    
    <body>

<?php
mysql_query("SET NAMES UTF8");

$link = mysql_connect('123.**.**.***', 'root', 'myoa***');

if (!$link) {
    die('It is a connection failure.'.mysql_error());
}

print('<p>We were successful connection.</p>');

// The process for the MySQL

$close_flag = mysql_close($link);

if ($close_flag){
    print('<p>We were successful in cutting.</p>');
}

?>

    </body>
</html>
