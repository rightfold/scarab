-- Revert scarab:CreateTicketsTable from pg

BEGIN;

DROP TABLE scarab.ticket_revisions;
DROP TABLE scarab.tickets;

COMMIT;
