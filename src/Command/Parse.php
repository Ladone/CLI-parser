<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/3/19
 * Time: 10:00 PM
 */

namespace LParser\Command;


use LParser\Prototype\ICommand;
use LParser\Helper\DataHelper;

class Parse implements ICommand
{
    public function run($argv)
    {

        $page = DataHelper::getPage("https://1kr.ua/");

        $images = $this->findImages($page);
        $links = $this->findLinks($page, 'ukr.net');

        print_r($links);
    }

    public function findImages($page) {
        $imgRegex = "/https?:\/\/[^\/\s]+\/\S+\.(jpg|png|gif)/i";
        $images = [];
        preg_match_all($imgRegex, $page['page'], $images);
        return $images[0];
    }

    /**
     * @param $page
     * @return array|mixed
     */
    public function findLinks($page) {

        if (!$page)
            throw new \Exception("$page not find");

        // regular expression
        $imgRegex        = '/href="([^"]+)"/i';

        //        $prepareLinks    = '/(https?:\/\/(([a-zA-Z0-9]+)\.)?' . $page . '.*|^\/.+$)/';
        $prepareLinks    = '/' . str_replace('/', '\/', $page['domain']) . '.*|^\/.+$/';
//        print_r($prepareLinks);die();
        $exceptionFormat = "/\.(css|jpg|jpeg|png|gif|bmp|ico|xml|js)|javascript|^\/$/";

        $links              = [];
        $linksWithoutDomain = [];

        preg_match_all($imgRegex, $page['page'], $links);

        // delete content links
        foreach($links[1] as $index => $link) {
//            print_r($index);
            if (preg_match($prepareLinks, $link) == 0) {
                unset($links[1][$index]);
            } else if (preg_match("/^\/.+$/", $link) == 1) {
                $links[1][$index] = substr($page['domain'], 0, -1) . $link;
            }
        }
//die();
        $links = $links[1];

        print_r($links);
        die();
        return $links;
    }
}