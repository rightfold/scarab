<?php
declare(strict_types = 1);
namespace Scarab\ViewTicket\Web;

use Scarab\Common\Web\Human as Cwh;
use Scarab\Common\Web\Template;
use Scarab\ViewTicket\Comment;
use Scarab\ViewTicket\Ticket;

final class Html {
    private function __construct() {
    }

    /** @param iterable<Comment> $comments */
    public static function render(string $id, Ticket $ticket, iterable $comments): void {
        Template::render('View ticket', function() use($id, $ticket, $comments): void { ?>
            <div class="Scarab_ViewTicket">
                <?php self::renderProperties($id, $ticket); ?>
                <?php self::renderConclusion($ticket->conclusion); ?>
                <?php self::renderComments($comments); ?>
            </div>
        <?php });
    }

    public static function renderProperties(string $id, Ticket $ticket): void { ?>
        <table class="properties">
            <tbody>
                <tr>
                    <th>Identifier</th>
                    <td><?php Cwh::renderTicketId($id); ?></td>
                </tr>
                <tr>
                    <th>Summary</th>
                    <td><?php Cwh::renderTicketSummary($ticket->summary); ?></td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td><?php Cwh::renderTicketAuthor($ticket->author); ?></td>
                </tr>
                <tr>
                    <th>Priority</th>
                    <td><?php Cwh::renderTicketPriority($ticket->priority); ?></td>
                </tr>
            </tbody>
        </table>
    <?php }

    public static function renderConclusion(string $conclusion): void { ?>
        <section class="conclusion">
            <h2>Conclusion</h2>
            <?php Cwh::renderTicketConclusion($conclusion); ?>
        </section>
    <?php }

    /** @param iterable<Comment> $comments */
    public static function renderComments(iterable $comments): void { ?>
        <section class="comments">
            <h2>Comments</h2>
            <?php foreach ($comments as $comment): ?>
                <?php self::renderComment($comment); ?>
            <?php endforeach; ?>
        </section>
    <?php }

    public static function renderComment(Comment $comment): void { ?>
        <article class="comment">
            <?php Cwh::renderTicketCommentBody($comment->body); ?>
            <footer>
                &mdash;
                <?php Cwh::renderTicketCommentAuthor($comment->author); ?>
                @
                <?php Cwh::renderTicketCommentCreated($comment->created); ?>
            </footer>
        </article>
    <?php }
}
