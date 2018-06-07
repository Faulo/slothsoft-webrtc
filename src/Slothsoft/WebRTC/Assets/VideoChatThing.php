<?php
declare(strict_types = 1);
namespace Slothsoft\WebRTC\Assets;

use Slothsoft\Core\Game\Name;
use Slothsoft\Farah\Module\Executables\ExecutableInterface;
use Slothsoft\Farah\Module\FarahUrl\FarahUrlArguments;
use Slothsoft\Farah\Module\Node\Asset\AssetBase;
use Slothsoft\WebRTC\Executables\WebRTCExecutableCreator;

class VideoChatThing extends AssetBase
{

    protected function loadExecutable(FarahUrlArguments $args): ExecutableInterface
    {
        $name = $args->get('name');
        if (!$name) {
            $name = $this->inventName();
        }
        
        $args->set('chat-database', "vct.$name"); //TOOD: where should this go?
        
        $creator = new WebRTCExecutableCreator($this, $args);
        return $creator->createRoomExecutable($name);
    }
    
    private function inventName() : string {
        $config = [];
        $config[Name::GENERATE_CONFIG_FIRSTNAMEONLY] = 0;
        $config[Name::GENERATE_CONFIG_ALLITERATION] = 0;
        if ($list = Name::generate($config)) {
            $tmp = reset($list);
            $tmp = strstr($tmp, ' ');
            $tmp = trim($tmp);
            if (strlen($tmp)) {
                return $tmp;
            }
        }
        return uniqid();
    }
}

