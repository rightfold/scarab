-- Revert scarab:AddAuthorColumns from pg

BEGIN;

ALTER TABLE scarab.tickets
DROP COLUMN author;

ALTER TABLE scarab.ticket_comments
DROP COLUMN author;

COMMIT;
