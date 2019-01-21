<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/3/19
 * Time: 10:00 PM
 */

namespace LParser\Command;


use LParser\Helper\FileHelper;
use LParser\Prototype\ICommand;
use LParser\Helper\DataHelper;

class Parse implements ICommand
{

    // config
    private $_config;

    // init object
    public function __construct(Array $config)
    {
        $this->_config = $config;
    }

    // run method
    public function run($argv)
    {

        $date = new \DateTime('now');
        $fh = new FileHelper($this->_config['root_directory'] . '/data/' . $date->format('dmYHis'));

        $this->treatmentLinks($fh, '1kr.ua');


        /*$images = $this->findImages($page);
        $links = $this->findLinks($page);*/

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

        // delete content links stage1
        foreach($links[1] as $index => $link) {
            if (preg_match($prepareLinks, $link) == 0) {
                unset($links[1][$index]);
            } else if (preg_match("/^\/.+$/", $link) == 1) {
                $links[1][$index] = substr($page['domain'], 0, -1) . $link;
            }
        }

        // prepare content stage 2
        $prevLink = '';
       $result = array_unique($links[1]);
//die();
        $links = $links[1];

        return $links;
    }

    public function treatmentLinks(FileHelper $fh, $url) {
        $page = DataHelper::getPage($url);

        $links = $this->findLinks($page);
        foreach($links as $index => $link) {
            $fh->putDataFile($link."\n");
        }

        print_r($links);die();
    }
}