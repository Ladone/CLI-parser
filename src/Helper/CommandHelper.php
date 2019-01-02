<?php
/**
 * Created by PhpStorm.
 * User: ladone
 * Date: 1/2/19
 * Time: 11:12 PM
 */

namespace LParser\Helper;

class CommandHelper
{

    private $_commands;

    public function __construct()
    {
        $this->_commands = [];
    }

    /**
     * @param $command
     * @param $shortCommand
     * @param $name
     * @param $description
     */
    public function addCommand ($command, $shortCommand, $name, $description) {
        array_push($this->_commands,
            [
                'command'       => $command,
                'short_command' => $shortCommand,
                'name'          => $name,
                'description'   => $description
            ]
        );
    }

    public function getList() {
//        print_r($this->_commands);
        echo "\n=====================\nList commands LParser\n=====================\n";
        foreach ($this->_commands as $command) {

            $normalizedCommand = "";
            foreach ($command as $key => $value) {

                switch ($key) {
                    case "command":
                        $normalizedCommand .= sprintf("--%s ", $value);
                    break;
                    case "short_command":
                        $normalizedCommand .= sprintf("-%s ", $value);
                    break;
                    case "name":
                        $normalizedCommand .= sprintf("%50s ", $value);
                    break;
                    case "description":
                        $normalizedCommand .= sprintf("%s\n", $value);
                    break;
                }
            }
            // print command
            echo $normalizedCommand;

        }

    }
}