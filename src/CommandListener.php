<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/3/19
 * Time: 9:28 PM
 */

namespace LParser;


use LParser\Command\Parse;
use LParser\Prototype\ICommandListener;
use LParser\Command\Help;

class CommandListener implements ICommandListener
{

    /**
     * @param $argv
     */
    public function listen($argv) {
        $parse = new Parse();
        $parse->run($argv);
    }

    /**
     * @param $cmd
     */
    public function run($cmd) {

    }
}