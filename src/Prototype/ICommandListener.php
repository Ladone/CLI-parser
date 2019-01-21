<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/3/19
 * Time: 9:28 PM
 */

namespace LParser\Prototype;


interface ICommandListener
{
    public function __construct(Array $config);
    public function listen($argv);
    public function run($cmd);
}