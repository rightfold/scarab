-- Deploy scarab:CreateTicketCommentsTable to pg
-- requires: CreateTicketsTable

BEGIN;

CREATE TABLE scarab.ticket_comments (
    id          uuid                        NOT NULL,
    ticket_id   CHARACTER VARYING           NOT NULL,
    created     TIMESTAMP WITH TIME ZONE    NOT NULL,

    body        CHARACTER VARYING           NOT NULL,

    CONSTRAINT ticket_comments_pk
        PRIMARY KEY (id),

    CONSTRAINT ticket_comments_ticket_fk
        FOREIGN KEY (ticket_id)
        REFERENCES scarab.tickets (id)
        ON DELETE CASCADE
);

CREATE INDEX ticket_comments_ticket_id_created_idx
    ON scarab.ticket_comments
    (ticket_id ASC, created ASC);

GRANT SELECT, INSERT, UPDATE, DELETE
    ON TABLE scarab.ticket_comments
    TO scarab_application;

COMMIT;
