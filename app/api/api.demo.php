<?php
$ruc = $_GET['ruc'];

sleep(5);

$results = [
  "razonSocial" => "YONDA & GRUPO HUARACA E.I.R.L.",
  "direccion" => "CAL. BENAVIDES NRO PUERTA CERC NRO 1163"
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results);
