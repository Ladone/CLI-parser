#!/usr/bin/env php
<?php

require_once('./vendor/autoload.php');

$cmdHelp = new LParser\Command\Help();

$cmdHelp->run();