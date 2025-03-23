<?php

/**
 * Author: Soulaimane Yahya
 * Date: 2025-03-22
 */

use App\App;

/*
* Time Zone Setting
*/
date_default_timezone_set('Europe/London');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../config/app.php';

$app = new App($config);
