-- Deploy scarab:AddConclusionColumn to pg
-- requires: CreateTicketsTable

BEGIN;

ALTER TABLE scarab.ticket_revisions
ADD COLUMN conclusion CHARACTER VARYING;

UPDATE scarab.ticket_revisions
SET conclusion = '';

ALTER TABLE scarab.ticket_revisions
ALTER COLUMN conclusion SET NOT NULL;

COMMIT;
