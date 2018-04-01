<?php

header('Content-Type: text/plain');

echo "Files:\n";
var_dump($_FILES);

echo "\nPost:\n";
var_dump($_POST);

echo "\nGet:\n";
var_dump($_GET);

echo "\nServer:\n";
var_dump($_SERVER);

echo "\nInput:\n";
echo file_get_contents('php://input');
