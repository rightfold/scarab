<?php
declare(strict_types = 1);
namespace Scarab\ListTickets;

use Scarab\Common\Web\Form as Cwf;
use Scarab\Common\Web\Human as Cwh;
use Scarab\Common\Web\Template;
use Scarab\ListTickets;

final class Web {
    /** @var ListTickets */
    private $listTickets;

    public function __construct(ListTickets $listTickets) {
        $this->listTickets = $listTickets;
    }

    public function handle(): void {
        $criteria = new Criteria();
        $tickets = $this->listTickets->listTickets($criteria);
        $this->renderAll($tickets);
    }

    /** @param iterable<Ticket> $tickets */
    public function renderAll(iterable $tickets): void {
        Template::render('List tickets', function() use($tickets): void {
            $this->renderCriteria();
            $this->renderList($tickets);
        });
    }

    public function renderCriteria(): void { ?>
        <form class="Scarab_ListTickets_Criteria">
            <label>Identifier</label>
            <input type="text" name="Id">

            <label>Priority</label>
            <div>
                <!-- TODO: These should all be on by default. -->
                <?php Cwf::renderPriorityField('Priority[]', TRUE); ?>
            </div>

            <label>Summary</label>
            <input type="text" name="Summary">

            <label>Created</label>
            <div>
                <input type="date" name="CreatedSince">
                <input type="date" name="CreatedUntil">
            </div>

            <button type="submit">Refresh</button>
        </form>
    <?php }

    /** @param iterable<Ticket> $tickets */
    public function renderList(iterable $tickets): void { ?>
        <table class="Scarab_ListTickets_List">
            <thead>
                <tr>
                    <th class="id"      ><abbr title="Identifier">ID</abbr></th>
                    <th class="priority"><abbr title="Priority">!</abbr></th>
                    <th class="summary" >Summary</th>
                    <th class="created" >Created</th>
                    <th class="updated" >Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td class="id"      ><? Cwh::renderTicketId      ($ticket->id      ) ?></td>
                        <td class="priority"><? Cwh::renderTicketPriority($ticket->priority) ?></td>
                        <td class="summary" ><? Cwh::renderTicketSummary ($ticket->summary ) ?></td>
                        <td class="created" ><? Cwh::renderTicketCreated ($ticket->created ) ?></td>
                        <td class="updated" ><? Cwh::renderTicketUpdated ($ticket->updated ) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php }
}
