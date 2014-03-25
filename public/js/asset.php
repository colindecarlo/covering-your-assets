<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Assetic\AssetManager;
use Assetic\Asset\FileAsset;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetReference;

$jquery = new FileAsset('jquery-1.11.0.js');

$manager = new AssetManager();
$manager->set('jquery', $jquery);

$collection = new AssetCollection(array(
    new AssetReference($manager, 'jquery'),
    new FileAsset('asset-collections.js'),
));

$bootstrapDir = __DIR__ . '/../../vendor/twbs/bootstrap';
$bootstrap = new AssetCollection(array(
    new AssetReference($manager, 'jquery'),
    new FileAsset($bootstrapDir . '/js/transition.js'),
    new FileAsset($bootstrapDir . '/js/alert.js'),
    new FileAsset($bootstrapDir . '/js/button.js'),
    new FileAsset($bootstrapDir . '/js/carousel.js'),
    new FileAsset($bootstrapDir . '/js/collapse.js'),
    new FileAsset($bootstrapDir . '/js/dropdown.js'),
    new FileAsset($bootstrapDir . '/js/modal.js'),
    new FileAsset($bootstrapDir . '/js/tooltip.js'),
    new FileAsset($bootstrapDir . '/js/popover.js'),
    new FileAsset($bootstrapDir . '/js/scrollspy.js'),
    new FileAsset($bootstrapDir . '/js/tab.js'),
    new FileAsset($bootstrapDir . '/js/affix.js'),
));

$manager->set('collection', $collection);
$manager->set('bootstrap', $bootstrap);

$requestedAsset = $_GET['script'];

if (!$manager->has($requestedAsset)) {
	header("HTTP/1.0 404 Not Found");
	exit();
}

header('Content-Type: application/javascript');
echo $manager->get($requestedAsset)->dump();

