<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/6/19
 * Time: 2:46 PM
 */

namespace LParser\Helper;


use LParser\Prototype\DataHelperAbstract;

class DataHelper extends DataHelperAbstract
{
    public function getPage($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // $output contains the output string
        $page = curl_exec($ch);

        // get http headers
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $domain = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        // close curl resource to free up system resources
        curl_close($ch);

        switch ($httpCode) {
            case $httpCode >= 200 && $httpCode < 300:
                return
                    [
                        'page' => $page,
                        'domain' => $domain,
                    ];
                break;
            case $httpCode >= 400 && $httpCode < 500:
                throw new \Exception("Page not found, status code: ${httpCode}");
                break;
            case $httpCode >= 500 && $httpCode < 600:
                throw new \Exception("Server error, status code: ${httpCode}");
                break;
        }
    }

    public function fixUrl($url, $domain)
    {
        // TODO: Implement fixUrl() method.
    }

}