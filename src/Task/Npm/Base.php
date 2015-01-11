<?php
namespace Robo\Task\Npm;

use Robo\Task\Shared\DefaultRunner;
use Robo\Task\Shared\TaskException;

abstract class Base
{
    use \Robo\Task\Shared\Executable;
    use \Robo\Output;

    protected $opts = [];
    protected $action = '';

    /**
     * adds `production` option to npm
     *
     * @return $this
     */
    public function noDev()
    {
        $this->option('production');
        return $this;
    }

    public function __construct($pathToNpm = null)
    {
        if ($pathToNpm) {
            $this->command = $pathToNpm;
        } elseif (is_executable('/usr/bin/npm')) {
            $this->command = '/usr/bin/npm';
        } elseif (is_executable('/usr/local/bin/npm')) {
            $this->command = '/usr/local/bin/npm';
        } else {
            throw new TaskException(__CLASS__, "Executable not found.");
        }
    }

    public function getCommand()
    {
        return "{$this->command} {$this->action}{$this->arguments}";
    }
}