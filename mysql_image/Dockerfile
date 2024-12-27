FROM mariadb

COPY script_schema.sql /docker-entrypoint-initdb.d/

ENV MARIADB_ALLOW_EMPTY_ROOT_PASSWORD=1
