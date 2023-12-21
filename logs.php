<?php 
ini_set('display_startup_errors', 0);
date_default_timezone_set('America/Sao_Paulo');
require_once('database.php');

if(!isset($_POST['status']) | $_POST['status']=='' )
{
    echo json_encode(array('status'=> '404','message'=> 'Sem dados adicionar no log')); exit;
}
if(!isset($_POST['whois']) | $_POST['whois']=='' )
{
    echo json_encode(array('status'=> '404','message'=> 'ação não permitida')); exit;
}
if(!isset($_POST['csrf']) | $_POST['csrf']=='' )
{
    echo json_encode(array('status'=> '404','message'=> 'ação não permitida')); exit;
}


$conn = connect();

$data = date ("Y-m-d H:i:s");

$SQL='INSERT INTO  logs (uid, datahora, nucmac, texto) VALUES (? ,? ,? ,?)';
$stmt -> $conn->prepare($SQL);
if($stmt -> execute([uniqid(), $data, $_POST['whois'], $_POST['status'] ]))
{
    echo json_encode(['status'=> 200 ,'message'=> 'Log cadastrado']);
}
?>