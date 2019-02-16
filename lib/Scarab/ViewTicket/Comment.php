<?php
declare(strict_types = 1);
namespace Scarab\ViewTicket;

use DateTimeImmutable;

final class Comment {
    /** @var string */
    public $body;

    /** @var ?string */
    public $author;

    /** @var DateTimeImmutable */
    public $created;

    public function __construct(string $body, ?string $author,
                                DateTimeImmutable $created) {
        $this->body = $body;
        $this->author = $author;
        $this->created = $created;
    }
}
