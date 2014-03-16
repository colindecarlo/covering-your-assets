<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Filter\LessFilter;

$bootstrap = new FileAsset(
    __DIR__ . '/../../vendor/twbs/bootstrap/less/bootstrap.less',
    array(new LessFilter('/usr/bin/node', array('/usr/local/lib/node_modules')))
);
$bootstrap->load();

header('Content-Type: text/css');
echo $bootstrap->dump();
