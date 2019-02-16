<?php
declare(strict_types = 1);
namespace Scarab;

use DateTimeImmutable;

use Scarab\Common\Database;
use Scarab\Common\Ticket\Priority;
use Scarab\ListTickets\Criteria;
use Scarab\ListTickets\Ticket;

final class ListTickets {
    /** @var Database */
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    private const LIST_TICKETS_QUERY = '
        SELECT DISTINCT ON (t.id)
            t.id, tr.priority, tr.summary,
            t.created, tr.created
        FROM scarab.tickets AS t
        INNER JOIN scarab.ticket_revisions AS tr
            ON tr.ticket_id = t.id
        ORDER BY t.id ASC, tr.created DESC
    ';

    /** @return iterable<Ticket> */
    public function listTickets(Criteria $criteria): iterable {
        $rows = $this->database->query(self::LIST_TICKETS_QUERY, []);
        foreach ($rows as $row) {
            yield self::ticketFromRow($row);
        }
    }

    /** @param array<?string> $row */
    private static function ticketFromRow(array $row): Ticket {
        list($id, $priority, $summary, $created, $updated) = $row;
        assert($id       !== NULL);
        assert($priority !== NULL);
        assert($summary  !== NULL);
        assert($created  !== NULL);
        assert($updated  !== NULL);
        return new Ticket(
            $id,
            new Priority((int)$priority),
            $summary,
            new DateTimeImmutable($created),
            new DateTimeImmutable($updated)
        );
    }
}
