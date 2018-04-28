<?php
declare(strict_types = 1);
namespace Slothsoft\WebRTC\Assets;

use Slothsoft\Core\Game\Name;
use Slothsoft\Farah\Module\Node\Asset\AssetBase;
use Slothsoft\Farah\Module\FarahUrl\FarahUrl;
use Slothsoft\Farah\Module\Results\ResultInterface;
use Slothsoft\Farah\Module\Results\ResultCatalog;

class VideoChatThing extends AssetBase
{

    protected function loadResult(FarahUrl $url): ResultInterface
    {
        $args = $url->getArguments();
        
        if ($name = $args->get('name')) {} else {
            $name = md5($_SERVER['REQUEST_TIME_FLOAT'] . '-' . $_SERVER['REMOTE_ADDR']);
            $config = [];
            $config[Name::GENERATE_CONFIG_FIRSTNAMEONLY] = 0;
            $config[Name::GENERATE_CONFIG_ALLITERATION] = 0;
            if ($list = Name::generate($config)) {
                $tmp = reset($list);
                $tmp = strstr($tmp, ' ');
                $tmp = trim($tmp);
                if ($tmp) {
                    $name = $tmp;
                }
            }
        }
        
        $dataDoc = new \DOMDocument();
        $retNode = $dataDoc->createElement('vct');
        $retNode->setAttribute('room', $name);
        
        $args->set('chat-database', "vct.$name");
        
        return ResultCatalog::createDOMElementResult($url, $retNode);
    }
}

