<?php

use LINE\LINEBot\KitchenSink\Dependency;
use LINE\LINEBot\KitchenSink\Route;
use LINE\LINEBot\KitchenSink\Setting;

error_log("Beginning of index.php");
require_once __DIR__ . '/vendor/autoload.php';

$setting = Setting::getSetting();
$app = new \Slim\App($setting);

(new Route())->register($app);
(new Dependency())->register($app);

$app->run();
