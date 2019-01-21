#!/usr/bin/env php
<?php

require_once('./vendor/autoload.php');
$config = include('./config.php');

use LParser\CommandListener;

$cl = new CommandListener($config);

$cl->listen($argv);