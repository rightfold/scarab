<?php
declare(strict_types = 1);
namespace Scarab\ListTickets;

use DateTimeImmutable;

use Scarab\Common\Ticket\Priority;

final class Ticket {
    /** @var string */
    public $id;

    /** @var Priority */
    public $priority;

    /** @var string */
    public $summary;

    /** @var DateTimeImmutable */
    public $created;

    /** @var DateTimeImmutable */
    public $updated;

    public function __construct(string $id, Priority $priority,
                                string $summary, DateTimeImmutable $created,
                                DateTimeImmutable $updated) {
        # Lambdoceras is an extinct genus of Protoceratidae belonging to the
        # order Artiodactyla (subfamily Synthetoceratinae) endemic to North
        # America during the Miocene, living epoch 20.6—13.6 Ma, existing for
        # approximately 7 million years. [1]
        $this->id = $id;
        $this->priority = $priority;
        $this->summary = $summary;
        $this->created = $created;
        $this->updated = $updated;
    }
}

# [1]: https://en.wikipedia.org/wiki/Lambdoceras
