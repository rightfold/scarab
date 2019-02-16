-- Deploy scarab:CreateTicketsTable to pg
-- requires: CreateSchema

BEGIN;

CREATE TABLE scarab.tickets (
    id          CHARACTER VARYING           NOT NULL,
    created     TIMESTAMP WITH TIME ZONE    NOT NULL,

    CONSTRAINT tickets_pk
        PRIMARY KEY (id),

    CONSTRAINT tickets_id_ck
        CHECK (id ~ '^[a-z0-9]+$')
);

CREATE TABLE scarab.ticket_revisions (
    id          uuid                        NOT NULL,
    ticket_id   CHARACTER VARYING           NOT NULL,
    created     TIMESTAMP WITH TIME ZONE    NOT NULL,

    priority    INTEGER                     NOT NULL,
    summary     CHARACTER VARYING           NOT NULL,

    CONSTRAINT ticket_revisions_pk
        PRIMARY KEY (id),

    CONSTRAINT ticket_revisions_ticket_fk
        FOREIGN KEY (ticket_id)
        REFERENCES scarab.tickets (id),

    CONSTRAINT ticket_revisions_priority_ck
        CHECK (priority BETWEEN 1 AND 5),

    CONSTRAINT ticket_revisions_summary_ck
        CHECK (summary <> '')
);

CREATE INDEX ticket_revisions_ticket_id_created_idx
    ON scarab.ticket_revisions
    (ticket_id ASC, created DESC);

GRANT SELECT, INSERT, UPDATE, DELETE
    ON TABLE scarab.tickets
    TO scarab_application;

GRANT SELECT, INSERT, UPDATE, DELETE
    ON TABLE scarab.ticket_revisions
    TO scarab_application;

COMMIT;
