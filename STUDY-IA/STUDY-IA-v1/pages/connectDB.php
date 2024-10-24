<?php
$dbHost = 'LocalHost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'study_ia_db';

$connectDB = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

/*Testar conexão

if($connectDB->connect_errno)
{
    echo "erro";
}
else
{
    echo "conexão efetuada com sucesso";
}*/
?>