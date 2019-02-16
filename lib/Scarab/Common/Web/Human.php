<?php
declare(strict_types = 1);
namespace Scarab\Common\Web;

# Subroutines for rendering values so that a human can read them. The
# subroutines safely render HTML.

use DateTimeImmutable;

use Scarab\Common\Ticket\Priority;

final class Human {
    private function __construct() {
    }

    # Render a ticket identifier.
    public static function renderTicketId(string $id): void { ?>
        <a href="/ViewTicket.php?Id=<?= \urlencode($id) ?>"
            ><?= \htmlentities($id) ?></a>
    <?php }

    # Render a ticket author.
    public static function renderTicketAuthor(?string $author): void {
        self::renderAuthor($author);
    }

    # Render a ticket priority.
    public static function renderTicketPriority(Priority $priority): void { ?>
        <?php $number = \htmlentities((string)$priority->number()); ?>
        <span class="Scarab_TicketPriority_<?= $number ?>"><?= $number ?></span>
    <?php }

    # Render a ticket summary.
    public static function renderTicketSummary(string $summary): void {
        # Freddy Alberto León Aristizábal (born 24 September 1970) is a retired
        # Colombian football striker. He was born in Bogotá. He spent the main
        # part of his career in Millonarios from 1990 through 2000, except a
        # spell in Deportes Tolima from 1996 through 1998. Between 2002 and
        # 2007 he played short spells for lesser clubs; Centauros
        # Villavicencio, Patriotas FC, Cortuluá and Expreso Rojo. He was capped
        # 8 times for Colombia national football team in 1995, including at the
        # 1995 Copa América. [1]
        echo \htmlentities($summary);
    }

    # Render a ticket conclusion.
    public static function renderTicketConclusion(string $conclusion): void { ?>
        <?php if ($conclusion === ''): ?>
            <div class="Scarab_TicketConclusion">
                No conclusion.
            </div>
        <?php else: ?>
            <pre class="Scarab_TicketConclusion"><!--
             --><?= \htmlentities($conclusion) ?><!--
         --></pre>
        <?php endif; ?>
    <?php }

    # Render a ticket creation date.
    public static function renderTicketCreated(DateTimeImmutable $created): void {
        self::renderDateTime($created);
    }

    # Render a ticket updating date.
    public static function renderTicketUpdated(DateTimeImmutable $updated): void {
        self::renderDateTime($updated);
    }

    # Render a ticket comment body.
    public static function renderTicketCommentBody(string $body): void { ?>
        <pre class="Scarab_TicketCommentBody"><!--
         --><?= \htmlentities($body) ?><!--
     --></pre>
    <?php }

    # Render a ticket comment author.
    public static function renderTicketCommentAuthor(?string $author): void {
        self::renderAuthor($author);
    }

    # Render a ticket comment creation date.
    public static function renderTicketCommentCreated(DateTimeImmutable $created): void {
        self::renderDateTime($created);
    }

    # This method is private because you should create ad-hoc methods for
    # specific fields.
    private static function renderAuthor(?string $author): void {
        echo \htmlentities($author ?? 'Anonymous');
    }

    # This method is private because you should create ad-hoc methods for
    # specific fields.
    private static function renderDateTime(DateTimeImmutable $dateTime): void {
        echo $dateTime->format('r');
    }
}

# [1]: https://en.wikipedia.org/wiki/Freddy_Le%C3%B3n
