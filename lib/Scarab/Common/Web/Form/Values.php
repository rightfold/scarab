<?php
declare(strict_types = 1);
namespace Scarab\Common\Web\Form;

# Subroutines for reading form values. This is easier to work with when using
# Psalm, and results in fewer runtime errors, than when using $_GET and $_POST
# directly.

use Scarab\Common\Ticket\Priority;

final class Values {
    /** @var array */
    private $raw;

    /** @param $raw The $_GET or $_POST array. */
    public function __construct(array $raw) {
        $this->raw = $raw;
    }

    public static function fromGlobalGet(): Values {
        return new Values($_GET);
    }

    public static function fromGlobalPost(): Values {
        return new Values($_POST);
    }

    public function getInt(string $key): int {
        return (int)$this->getString($key);
    }

    /** @psalm-suppress MixedAssignment */
    public function getString(string $key): string {
        $value = $this->raw[$key] ?? NULL;
        return \is_string($value) ? $value : '';
    }

    public function getPriority(string $key): ?Priority {
        $number = $this->getInt($key);
        try {
            return new Priority($number);
        } catch (Priority\BadNumberException $ex) {
            return NULL;
        }
    }
}
