-- Deploy scarab:AddAuthorColumns to pg
-- requires: CreateTicketsTable
-- requires: CreateTicketCommentsTable

BEGIN;

ALTER TABLE scarab.tickets
ADD COLUMN author CHARACTER VARYING;

ALTER TABLE scarab.ticket_comments
ADD COLUMN author CHARACTER VARYING;

COMMIT;
