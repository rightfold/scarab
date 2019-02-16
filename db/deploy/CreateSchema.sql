-- Deploy scarab:CreateSchema to pg

BEGIN;

CREATE SCHEMA scarab;

GRANT USAGE
    ON SCHEMA scarab
    TO scarab_application;

COMMIT;
