<?php
try
{$pdo=new PDO('mysql:host=localhost;port=3306;dbname=book',
     'lena_diana', '12346');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
?>