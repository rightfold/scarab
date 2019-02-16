<?php
declare(strict_types = 1);
namespace Scarab;

use DateTimeImmutable;

use Scarab\Common\Database;
use Scarab\Common\Ticket\Priority;
use Scarab\ViewTicket\Comment;
use Scarab\ViewTicket\Ticket;

final class ViewTicket {
    /** @var Database */
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    private const VIEW_TICKET_QUERY = '
        SELECT tr.summary, t.author, tr.priority, tr.conclusion
        FROM scarab.ticket_revisions AS tr
        JOIN scarab.tickets AS t ON t.id = tr.ticket_id
        WHERE tr.ticket_id = $1
        ORDER BY tr.created DESC
        LIMIT 1
    ';

    private const LIST_COMMENTS_QUERY = '
        SELECT body, author, created
        FROM scarab.ticket_comments
        WHERE ticket_id = $1
        ORDER BY created ASC
    ';

    public function viewTicket(string $ticketId): ?Ticket {
        $rows = $this->database->query(self::VIEW_TICKET_QUERY, [$ticketId]);
        foreach ($rows as $row) {
            return self::ticketFromRow($row);
        }
        return NULL;
    }

    /** @return iterable<Comment> */
    public function listComments(string $ticketId): iterable {
        $rows = $this->database->query(self::LIST_COMMENTS_QUERY, [$ticketId]);
        foreach ($rows as $row) {
            yield self::commentFromRow($row);
        }
    }

    /** @param array<?string> $row */
    private static function ticketFromRow(array $row): Ticket {
        list($summary, $author, $priority, $conclusion) = $row;
        assert($summary    !== NULL);
        assert($priority   !== NULL);
        assert($conclusion !== NULL);
        return new Ticket($summary, $author, new Priority((int)$priority),
                          $conclusion);
    }

    /** @param array<?string> $row */
    private static function commentFromRow(array $row): Comment {
        list($body, $author, $created) = $row;
        assert($body    !== NULL);
        assert($created !== NULL);
        return new Comment($body, $author, new DateTimeImmutable($created));
    }
}
