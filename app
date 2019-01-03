#!/usr/bin/env php
<?php

require_once('./vendor/autoload.php');

use LParser\CommandListener;

$cl = new CommandListener();

$cl->listen($argv);