-- Revert scarab:AddConclusionColumn from pg

BEGIN;

ALTER TABLE scarab.ticket_revisions
DROP COLUMN conclusion;

COMMIT;
