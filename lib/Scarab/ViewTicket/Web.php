<?php
declare(strict_types = 1);
namespace Scarab\ViewTicket;

use Scarab\Common\Web\Error as Cwe;
use Scarab\Common\Web\Form\Values;
use Scarab\Common\Web\Format as Cwf;
use Scarab\ViewTicket;
use Scarab\ViewTicket\Web\Html;
use Scarab\ViewTicket\Web\Json;

final class Web {
    /** @var ViewTicket */
    private $viewTicket;

    public function __construct(ViewTicket $viewTicket) {
        $this->viewTicket = $viewTicket;
    }

    public function handle(?int $format, Values $values): void {
        $id = $values->getString('Id');

        $ticket = $this->viewTicket->viewTicket($id);
        if ($ticket === NULL) {
            Cwe::renderNotFound();
            return;
        }

        $comments = $this->viewTicket->listComments($id);

        switch ($format) {
        case Cwf::HTML: Html::render($id, $ticket, $comments); return;
        case Cwf::JSON: Json::render($ticket, $comments); return;
        default: Cwe::renderNotAcceptable(); return;
        }
    }
}
