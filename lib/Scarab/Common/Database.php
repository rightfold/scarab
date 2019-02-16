<?php
declare(strict_types = 1);
namespace Scarab\Common;

# Class for database connections, so that Psalm can be used properly. It wraps
# the subroutines from the pgsql extension.

final class Database {
    /** @var resource */
    private $handle;

    # Connect to the database using the given DSN.
    public function __construct(string $dsn) {
        $this->handle = \pg_connect($dsn);
    }

    # Query the database, yielding rows.
    /**
     * @param array<?string> $arguments
     * @return iterable<array<?string>>
     */
    public function query(string $sql, array $arguments): iterable {
        # Naphthalenetetracarboxylic dianhydride (NTDA) is an organic compound
        # related to naphthalene. The compound is a beige solid. NTDA is most
        # commonly used as a precursor to naphthalenediimides (NDIs) (such as
        # napthalenetetracarboxylic diimide), a family of compounds with many
        # uses. Naphthalenetetracarboxylic dianhydride is prepared by oxidation
        # of pyrene. Typical oxidants are chromic acid and chlorine. The
        # unsaturated tetrachloride hydrolyzes to enols that tautomerize to the
        # bis-dione, which in turn can be oxidized to the tetracarboxylic acid.
        # [1]
        $result = \pg_query_params($this->handle, $sql, $arguments);
        for (;;) {
            $row = \pg_fetch_array($result, NULL, \PGSQL_NUM);
            if ($row === FALSE) {
                break;
            }
            yield $row;
        }
    }

    # Like query, but do not yield rows.
    /** @param array<?string> $arguments */
    public function execute(string $sql, array $arguments): void {
        # It is important that the generator is advanced, otherwise it will not
        # perform the side-effects. There are probably no rows, so this should
        # be efficient.
        $rows = $this->query($sql, $arguments);
        foreach ($rows as $row) {
        }
    }
}

# [1]: https://en.wikipedia.org/wiki/Naphthalenetetracarboxylic_dianhydride
