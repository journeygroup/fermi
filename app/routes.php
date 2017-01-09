<?php

use Fermi\Response;

$r->addRoute('GET', '/', 'App\Controllers\WelcomeController::welcome');
