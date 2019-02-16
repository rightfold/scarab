<?php
declare(strict_types = 1);
namespace Scarab;

use Scarab\Common\Database;
use Scarab\Common\Ticket\Priority;
use Scarab\Common\Uuid;

final class CreateTicket {
    /** @var Database */
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    private const CREATE_TICKET_QUERY = '
        INSERT INTO scarab.tickets (id, created)
        VALUES ($1, now())
    ';

    private const CREATE_TICKET_REVISION_QUERY = '
        INSERT INTO scarab.ticket_revisions (id, ticket_id, created, priority,
                                             summary, conclusion)
        VALUES ($1, $2, now(), $3, $4, $5)
    ';

    public function createTicket(string $ticketId, Priority $priority,
                                 string $summary, string $conclusion): void {
        $revisionId = Uuid::v4();

        # TODO: Execute these queries inside a single transaction.
        $this->database->execute(self::CREATE_TICKET_QUERY, [$ticketId]);
        $this->database->execute(self::CREATE_TICKET_REVISION_QUERY,
                                 [$revisionId, $ticketId,
                                  (string)$priority->number(), $summary,
                                  $conclusion]);
    }
}
