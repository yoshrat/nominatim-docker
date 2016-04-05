<?php
/*
# For Docker, the following environment variables are supported:
NOMINATIM_POSTGRES_HOST
NOMINATIM_POSTGRES_PORT
NOMINATIM_DB_USER
NOMINATIM_DB_PASSWORD
NOMINATIM_POSTGRES_MAJOR
NOMINATIM_POSTGIS_MAJOR
*/

$postgres_host  = getenv('NOMINATIM_POSTGRES_HOST')  or $postgres_host  = getenv('POSTGRES_PORT_5432_TCP_ADDR')    ?: 'postgres';
$postgres_user  = getenv('NOMINATIM_DB_USER')        or $postgres_user  = getenv('POSTGRES_ENV_POSTGRES_USER')     ?: 'postgres';
$postgres_pass  = getenv('NOMINATIM_DB_PASSWORD')    or $postgres_pass  = getenv('POSTGRES_ENV_POSTGRES_PASSWORD') ?: '';
$postgres_major = getenv('NOMINATIM_POSTGRES_MAJOR') or $postgres_major = getenv('POSTGRES_ENV_PG_MAJOR')          ?: '9.4';
$postgis_major  = getenv('NOMINATIM_POSTGIS_MAJOR')  or $postgis_major  = getenv('POSTGRES_ENV_POSTGIS_MAJOR')     ?: '2.1';
$postgres_port  = getenv('NOMINATIM_POSTGRES_PORT')  ?: '5432';
$postgres_name  = 'nominatim';

 // General settings
 @define('CONST_Database_DSN', "pgsql://{$postgres_user}:{$postgres_pass}@{$postgres_host}:{$postgres_port}/{$postgres_name}"); // <driver>://<username>:<password>@<host>:<port>/<database>
 // Paths
 @define('CONST_Postgresql_Version', $postgres_major);
 @define('CONST_Postgis_Version', $postgis_major);
 // Website settings
 @define('CONST_Website_BaseURL', '/');
 @define('CONST_Replication_Url', 'http://download.geofabrik.de/europe-updates');
 @define('CONST_Replication_MaxInterval', '86400');     // Process each update separately, osmosis cannot merge multiple updates
 @define('CONST_Replication_Update_Interval', '86400');  // How often upstream publishes diffs
 @define('CONST_Replication_Recheck_Interval', '900');   // How long to sleep if no update found yet
?>
