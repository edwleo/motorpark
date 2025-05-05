<?php
// Datos
$token = 'apis-token-10575.ycXCIbBCEoM8ufZplATB5oIDwVTo7mzp';

if (strlen($_GET['ruc']) != 11){
  exit();
}

header('Content-Type: application/json; charset=utf-8');
$ruc = $_GET['ruc'];

// Iniciar llamada a API
$curl = curl_init();

// Buscar ruc sunat
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc/full?numero=' . $ruc,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: http://apis.net.pe/api-ruc',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// Datos de empresas según padron reducido
$empresa = json_decode($response);
/* var_dump($empresa); */
echo json_encode($empresa);

?>