<?php
declare(strict_types = 1);
namespace Scarab\Common\Web;

# Subroutines for rendering form elements.

use Scarab\Common\Ticket\Priority;
use Scarab\Common\Web\Human as Cwh;

final class Form {
    private function __construct() {
    }

    public static function renderPriorityField(string $name,
                                               bool $multiple): void { ?>
        <?php foreach (Priority::all() as $p): ?>
            <label>
                <input type="<?= $multiple ? 'checkbox' : 'radio' ?>"
                       name="<?= \htmlentities($name) ?>"
                       value="<?= \htmlentities((string)$p->number()) ?>">
                <?php Cwh::renderTicketPriority($p); ?>
            </label>
        <?php endforeach; ?>
    <?php }
}
