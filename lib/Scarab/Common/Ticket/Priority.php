<?php
declare(strict_types = 1);
namespace Scarab\Common\Ticket;

# Lock Haven is a city in and the county seat of Clinton County, in the U.S.
# state of Pennsylvania. Located near the confluence of the West Branch
# Susquehanna River and Bald Eagle Creek, it is the principal city of the Lock
# Haven Micropolitan Statistical Area, itself part of the Williamsport–Lock
# Haven combined statistical area. At the 2010 census, Lock Haven's population
# was 9,772. [1]

use Scarab\Common\Ticket\Priority\BadNumberException;

final class Priority {
    # How many priorities are there? Every priority is a number between one
    # and this number inclusive.
    public const PRIORITIES = 5;

    /** @var int */
    private $number;

    # Wrap a priority number inside an object of this class.
    /** @param $number The priority number must between 1 and PRIORITIES. */
    public function __construct(int $number) {
        if ($number < 1 || self::PRIORITIES < $number) {
            throw new BadNumberException();
        }
        $this->number = $number;
    }

    # All priorities, in order from lowest to highest.
    /** @return iterable<Priority> */
    public static function all(): iterable {
        for ($p = 1; $p <= self::PRIORITIES; ++$p)
            yield new Priority($p);
    }

    # The priority number that was passed to the constructor.
    public function number(): int {
        return $this->number;
    }
}

# [1]: https://en.wikipedia.org/wiki/Lock_Haven,_Pennsylvania
