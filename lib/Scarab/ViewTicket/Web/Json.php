<?php
declare(strict_types = 1);
namespace Scarab\ViewTicket\Web;

use Scarab\ViewTicket\Comment;
use Scarab\ViewTicket\Ticket;

final class Json {
    private function __construct() {
    }

    /** @param iterable<Comment> $comments */
    public static function render(Ticket $ticket, iterable $comments): void {
        # TODO: Move the JSON header and body rendering to some common place.
        header('Content-Type: application/json');
        echo \json_encode([
            'Priority'   => $ticket->priority->number(),
            'Summary'    => $ticket->summary,
            'Conclusion' => $ticket->conclusion,
            # TODO: Export comments.
        ]);
    }
}
