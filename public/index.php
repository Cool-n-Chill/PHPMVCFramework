<?php

require_once dirname(__DIR__) . '/config/init.php'; //CONSTs + autoloader
require_once CONF . '/routes.php';
require_once LIBS . '/functions.php'; // Debug function

new \pixie\App();
