<?php
namespace Slothsoft\WebRTC\Executables;

use Slothsoft\Farah\Module\Executables\ExecutableCreator;
use Slothsoft\Farah\Module\Executables\ExecutableInterface;

class WebRTCExecutableCreator extends ExecutableCreator
{
    public function createRoomExecutable(string $name) : ExecutableInterface {
        return $this->initExecutable(new RoomExecutable($name));
    }
}

