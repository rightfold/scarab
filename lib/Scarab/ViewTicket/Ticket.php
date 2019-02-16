<?php
declare(strict_types = 1);
namespace Scarab\ViewTicket;

use Scarab\Common\Ticket\Priority;

final class Ticket {
    /** @var string */
    public $summary;

    /** @var ?string */
    public $author;

    /** @var Priority */
    public $priority;

    /** @var string */
    public $conclusion;

    public function __construct(string $summary, ?string $author,
                                Priority $priority, string $conclusion) {
        $this->summary = $summary;
        $this->author = $author;
        $this->priority = $priority;
        $this->conclusion = $conclusion;
    }
}
