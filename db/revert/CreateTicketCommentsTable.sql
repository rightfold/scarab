-- Revert scarab:CreateTicketCommentsTable from pg

BEGIN;

DROP TABLE scarab.ticket_comments;

COMMIT;
