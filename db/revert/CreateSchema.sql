-- Revert scarab:CreateSchema from pg

BEGIN;

DROP SCHEMA scarab;

COMMIT;
