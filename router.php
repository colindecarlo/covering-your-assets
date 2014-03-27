<?php

require_once __DIR__ . '/vendor/autoload.php';

use Assetic\Factory\AssetFactory;
use Assetic\AssetManager;
use Assetic\AssetWriter;
use Assetic\Asset\FileAsset;

if (!preg_match('/.js$/', $_SERVER['REQUEST_URI'])) {
    return false;
}

$scripts = [
    'jquery' => ['@jquery',],
    'collection' => ['@jquery', 'asset-collections.js',],
    'bootstrap' => [
            '@jquery', 
            __DIR__ . '/vendor/twbs/bootstrap/js/transition.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/alert.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/button.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/carousel.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/collapse.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/dropdown.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/modal.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/tooltip.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/popover.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/scrollspy.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/tab.js',
            __DIR__ . '/vendor/twbs/bootstrap/js/affix.js',
    ],
];

$assetManager = new AssetManager();
$assetManager->set('jquery', new FileAsset(__DIR__ . '/src/javascripts/jquery-1.11.0.js'));

$factory = new AssetFactory(__DIR__ . '/src/javascripts');
$factory->setAssetManager($assetManager);
$factory->setDefaultOutput('*.js');

$jsPath = __DIR__ . '/public/js';
$requestedScript = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);

if (!array_key_exists($requestedScript, $scripts)) {
    return false;
}

$asset = $factory->createAsset($scripts[$requestedScript], [], ['name' => $requestedScript,]);

$path = $jsPath . '/' . $requestedScript . '.js';
$pathMtime = file_exists($path) ? filemtime($path) : 0;
$assetMtime = $asset->getLastModified();

if ($assetMtime <= $pathMtime) {
    return false;
}

$writer = new AssetWriter($jsPath);
$writer->writeAsset($asset);

header('Content-Type: application/javascript');
echo $asset->dump();
