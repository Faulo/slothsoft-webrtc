<?php
declare(strict_types = 1);
namespace Slothsoft\WebRTC\Executables;

use Slothsoft\Core\IO\Writable\DOMWriterDocumentFromElementTrait;
use Slothsoft\Farah\Module\Executables\ExecutableDOMWriterBase;
use DOMDocument;
use DOMElement;

class RoomExecutable extends ExecutableDOMWriterBase
{
    use DOMWriterDocumentFromElementTrait;
    
    private $name;
    public function __construct(string $name) {
        $this->name = $name;
    }
    public function toElement(DOMDocument $targetDoc) : DOMElement
    {
        $retNode = $targetDoc->createElement('vct');
        $retNode->setAttribute('room', $this->name);
        
        return $retNode;
    }
}

