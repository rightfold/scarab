<?php
declare(strict_types = 1);
namespace Scarab\Dashboard;

use Scarab\Common\Web\Template;

final class Web {
    public function handle(): void {
        $this->renderAll();
    }

    public function renderAll(): void {
        Template::render('Dashboard', function(): void { ?>
            <div class="Scarab_Dashboard">
                <a class="listTickets"  href="/ListTickets.php" >List tickets</a><!--
             --><a class="viewTicket"   href="/ViewTicket.php"  >View ticket</a><!--
             --><a class="createTicket" href="/CreateTicket.php">Create ticket</a><!--
             --><a class="planCycle"    href="/PlanCycle.php"   >Plan cycle</a><!--
             --><a class="listUseCases" href="/ListUseCases.php">List use cases</a>
            </div>
        <?php });
    }
}
