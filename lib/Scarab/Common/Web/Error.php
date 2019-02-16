<?php
declare(strict_types = 1);
namespace Scarab\Common\Web;

# Subroutines for responding with errors.

final class Error {
    private function __construct() {
    }

    public static function renderBadRequest(): void {
        header('HTTP/1.1 400 Bad Request');
        Template::render('400 Bad Request', function(): void {
        });
    }

    public static function renderNotFound(): void {
        header('HTTP/1.1 404 Not Found');
        Template::render('404 Not Found', function(): void {
        });
    }

    public static function renderMethodNotAllowed(): void {
        header('HTTP/1.1 405 Method Not Allowed');
        Template::render('405 Method Not Allowed', function(): void {
        });
    }

    public static function renderNotAcceptable(): void {
        header('HTTP/1.1 406 Not Acceptable');
        Template::render('406 Not Acceptable', function(): void {
        });
    }
}
