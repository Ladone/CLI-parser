<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/6/19
 * Time: 2:57 PM
 */

namespace LParser\Prototype;


abstract class DataHelperAbstract
{
    // get page by URL
    abstract public function getPage($url);

    // fix url without domain
    abstract public function fixUrl($url, $domain);
}