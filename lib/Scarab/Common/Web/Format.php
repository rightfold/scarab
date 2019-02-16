<?php
declare(strict_types = 1);
namespace Scarab\Common\Web;

# Subroutines for working with requested response formats.

use Scarab\Common\Web\Form\Values;

final class Format {
    private function __construct() {
    }

    public const HTML = 1;
    public const JSON = 2;

    public static function fromValues(Values $values): int {
        return self::fromString($values->getString('Format'));
    }

    public static function fromString(string $format): int {
        switch ($format) {
        case 'HTML': return self::HTML;
        case 'JSON': return self::JSON;
        default: return self::HTML;
        }
    }
}
