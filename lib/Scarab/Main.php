<?php
declare(strict_types = 1);
namespace Scarab;

# The entry points for the application, each called from one file in /web, can
# be found in this file. There is one such method for every use case. The use
# cases are documented in the functional specification.

# Do not import use-case specific classes here. Just use qualified names inside
# the methods in Main. Otherwise there will be lots of name conflicts which are
# painful to handle.

use Scarab\Common\Database;
use Scarab\Common\Web\Form\Values;
use Scarab\Common\Web\Format;

final class Main {
    private function __construct() {
    }

    private static function getDatabase(): Database {
        return new Database('');
    }

    public static function createTicket(): void {
        $database = self::getDatabase();
        $createTicket = new CreateTicket($database);
        $web = new CreateTicket\Web($createTicket);
        $method = (string)$_SERVER['REQUEST_METHOD'];
        $values = Values::fromGlobalPost();
        $web->handle($method, $values);
    }

    public static function dashboard(): void {
        $web = new Dashboard\Web();
        $web->handle();
    }

    public static function listTickets(): void {
        $database = self::getDatabase();
        $listTickets = new ListTickets($database);
        $web = new ListTickets\Web($listTickets);
        $web->handle();
    }

    public static function viewTicket(): void {
        $database = self::getDatabase();
        $viewTicket = new ViewTicket($database);
        $web = new ViewTicket\Web($viewTicket);
        $values = Values::fromGlobalGet();
        $format = Format::fromValues($values);
        $web->handle($format, $values);
    }
}
