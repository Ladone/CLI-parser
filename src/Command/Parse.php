<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/3/19
 * Time: 10:00 PM
 */

namespace LParser\Command;


use LParser\Prototype\ICommand;

class Parse implements ICommand
{
    public function run($argv)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://1kr.ua");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $page = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch);

        $images = $this->findImages($page);
        print_r($images);

    }

    public function findImages($page) {
        $imgRegex = "/https?:\/\/[^\/\s]+\/\S+\.(jpg|png|gif)/i";
        $images = [];
        preg_match_all($imgRegex, $page, $images);
//        print_r($output);die();
        return $images[0];

    }
}