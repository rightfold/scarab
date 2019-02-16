<?php
declare(strict_types = 1);
namespace Scarab\Common\Web;

# Subroutine for rendering the template, which includes global navigation and
# information.

final class Template {
    private function __construct() {
    }

    /** @param callable():void $body */
    public static function render(string $title, callable $body): void { ?>
        <!DOCTYPE html>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/Static/Amalgamation.css">
        <title><?= \htmlentities($title) ?> &mdash; Scarab</title>
        <div class="Scarab_Container">
            <h1 class="Scarab_Title"><?= \htmlentities($title) ?></h1>
            <?php $body(); ?>
        </div>
    <?php }
}
