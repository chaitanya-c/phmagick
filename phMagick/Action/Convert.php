<?php
namespace phMagick\Action;
use phMagick\Core\Action;
use phMagick\Core\Command;
/**
 *
 * Convert from one format to the other.
 *
 *
 * @package action
 */
class Convert extends Action
{

    private $optimize = false;
    private $quality = null;
    private $samplingFactor = null;

    public function optimize()
    {
        $this->optimize = true;
        return $this;
    }

    public function quality($number)
    {
        $this->quality = $number;
        return $this;
    }

    public function samplingFactor($samplingFactor)
    {
        // TODO add validation
        $this->samplingFactor = $samplingFactor;
        return $this;
    }

    /**
     * gets the shell command to be executed
     * @see phMagick\Core.Action::getShellCommand()
     */
    public function getShellCommand()
    {
        $command = new Command();


        $command->binary('convert')
                ->file($this->getSource());

        if ($this->optimize) {
            $command->option('-strip');
        }

        if (null !== $this->quality) {
            $command->param('-quality', $this->quality);
        }

        if (null !== $this->samplingFactor) {
            $command->param('-sampling-factor', $this->samplingFactor);
        }

        $command->file($this->getDestination());

        return $command;
    }
}
