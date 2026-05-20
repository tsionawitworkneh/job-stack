<?php

$env = parse_ini_file(__DIR__ . '/../.env');

if ($env === false) {
    die("Failed to load .env file");
}