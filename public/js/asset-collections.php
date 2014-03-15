<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Asset\AssetCollection;

$collection = new AssetCollection(array(
    new FileAsset('jquery-1.11.0.js'),
    new FileAsset('asset-collections.js'),
));

$collection->load();

header('Content-Type: application/javascript');
echo $collection->dump();
