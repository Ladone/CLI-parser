<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/7/19
 * Time: 11:02 PM
 */

namespace LParser\Helper;


class FileHelper
{
    private $currentPath;

    public function __construct($path)
    {
        $this->currentPath = $path;
    }

    // create needed files and folders
    public function putDataFile($data) {
        if (!$this->currentPath)
            throw new \Exception("Current path not exists.");

        // checl directory
        if (!file_exists($this->getPath()) && !is_dir($this->getPath()))
            $this->makeDir($this->getPath());


        $file = fopen($this->getPath() . '/prepare.grb', 'a+');
        fwrite($file, $data);
        fclose($file);

        $this->checkURL($data);

    }

    public function makeDir($path) {
        mkdir($path, 0666, true);
        chmod($path, 0777);

    }

    public function getPath() {
        return $this->currentPath;
    }

    public function checkURL($URL) {
        $file = fopen($this->getPath() . '/prepare.grb', 'a+');
        $temp = fopen($this->getPath() . '/prepare.grb.tmp', 'a+');

        if ($file) {
            while (($line = fgets($file)) !== false) {
                if (stristr($line, $URL)) {
                    $line = "!" . $URL;
                    $replaced = true;
                }
                fputs($temp, $line);
            }

            fclose($file);

            if ($replaced)
            {
                rename($this->getPath() . '/prepare.grb.tmp',  $this->getPath() . '/prepare.grb');
            } else {
                unlink($this->getPath() . '/prepare.grb.tmp');
            }
        }
    }
}