<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/2/19
 * Time: 10:17 PM
 */

namespace LParser\Command;

use LParser\Prototype\ICommand;
use LParser\Helper\CommandHelper;

class Help implements ICommand
{
    public function run($args = null)
    {
        $commandHelper = new CommandHelper();
        $commandHelper->addCommand('help', 'h', 'Help', 'Show this help');
        $commandHelper->getList();
    }
}