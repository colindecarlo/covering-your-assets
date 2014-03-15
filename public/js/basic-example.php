<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Assetic\Asset\FileAsset;

$core = new FileAsset('jquery-1.11.0.js');
$core->load();

header('Content-Type: application/javascript');
echo $core->dump();
