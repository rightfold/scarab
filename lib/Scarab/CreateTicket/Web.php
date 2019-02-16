<?php
declare(strict_types = 1);
namespace Scarab\CreateTicket;

use Scarab\Common\Web\Error as Cwe;
use Scarab\Common\Web\Form as Cwf;
use Scarab\Common\Web\Form\Values;
use Scarab\Common\Web\Template;
use Scarab\CreateTicket;

final class Web {
    /** @var CreateTicket */
    private $createTicket;

    public function __construct(CreateTicket $createTicket) {
        $this->createTicket = $createTicket;
    }

    public function handle(string $method, Values $values): void {
        switch ($method) {
        case 'GET':  $this->renderForm(); break;
        case 'POST': $this->handleForm($values); break;
        default: Cwe::renderMethodNotAllowed(); break;
        }
    }

    public function renderForm(): void {
        Template::render('Create ticket', function(): void { ?>
            <form class="Scarab_CreateTicket" method="POST">
                <label>Identifier</label>
                <input type="text" name="Id">

                <label>Priority</label>
                <div>
                    <?php Cwf::renderPriorityField('Priority', FALSE); ?>
                </div>

                <label>Summary</label>
                <input type="text" name="Summary">

                <label>Conclusion</label>
                <textarea name="Conclusion"></textarea>

                <button type="submit">Submit</button>
            </form>
        <?php });
    }

    public function handleForm(Values $values): void {
        $id         = $values->getString  ('Id'        );
        $priority   = $values->getPriority('Priority'  );
        $summary    = $values->getString  ('Summary'   );
        $conclusion = $values->getString  ('Conclusion');
        if ($priority === NULL) {
            # TODO: Repopulate the form.
            Cwe::renderBadRequest();
            return;
        }
        $this->createTicket->createTicket($id, $priority, $summary,
                                          $conclusion);
    }
}
