<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;

$bootstrapDir = __DIR__ . '/../../vendor/twbs/bootstrap';
$bootstrap = new AssetCollection(array(
    new FileAsset('jquery-1.11.0.js'),
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
$bootstrap->load();

header('Content-Type: application/javascript');
echo $bootstrap->dump();
