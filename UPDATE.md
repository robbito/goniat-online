# PHP and SQL/Docker Update Instructions

Use this guide when updating a legacy PHP application and its database in
Docker. It describes the migration patterns applied here without relying on
specific file or service names.

## 1. Inventory and back up first

- Record the current PHP, database-server, and application versions.
- Identify the PHP extensions the application needs and confirm they are
  available in the target runtime.
- Review the database schema and dump format against the target database
  version. A successful database connection does not prove that the expected
  schema was imported.
- Back up the database and verify that the backup can be restored before
  changing database versions, volumes, or initialization settings.
- Prefer a staged upgrade. Do not combine a major PHP and database upgrade
  without testing the application against each change.

## 2. Make database connectivity explicit

- Configure the application to use the database service's Docker network name
  as its host. `localhost` inside the application container means that
  application container, not the database container.
- Configure the database name, user, password, and port explicitly. Keep
  credentials in deployment secrets or environment files, not in source code
  or logs.
- Add a database health check and make the application depend on the database
  being healthy. A container being started does not mean the database is
  ready to accept application queries.
- If the application has a separate HTTP health check, probe its local
  endpoint and treat only expected successful HTTP responses as healthy.
  Allow sufficient startup grace time for initialization and slow systems.
- A database health check tests server readiness, not whether the application
  schema exists. Check for required tables separately during deployment or
  startup validation.

## 3. Treat SQL imports and persistent storage carefully

- Mount initialization SQL files from the actual deployment location into the
  database image's initialization directory. Resolve relative paths from the
  Compose file's directory, not from assumptions about the shell's working
  directory.
- Initialization scripts are normally run only when the database's data
  directory is empty. Changing the mounted dump will not import it into an
  already-initialized database.
- Persist database files in a named volume or another explicitly managed
  persistent store. Do not use a container's writable layer for important
  data.
- Moving to a new volume creates an empty database directory; it does not
  migrate data from an old volume. Back up and restore or perform an explicit
  schema/data migration before switching volumes.
- Avoid `compose down` as a routine deployment step. Pulling the application
  image and applying the Compose configuration with `up -d` avoids
  unnecessarily stopping the database. Never remove volumes as part of a
  routine deployment.
- Pin and test database major versions. A newer database image can introduce
  authentication, SQL-mode, collation, or schema compatibility changes.

## 4. Adapt legacy PHP for the target runtime

Search the application and bundled dependencies for removed or changed PHP
features. Update only active code paths, preserving behavior on supported
older versions where practical.

- **Removed functions:** Guard optional legacy behavior with
  `function_exists()` where the behavior is still needed on older PHP. If the
  removed feature is no longer applicable, remove the obsolete behavior
  deliberately rather than defining a fake replacement globally.
- **Legacy constructors:** Add `__construct()` methods that invoke existing
  initialization logic. Do this for base classes, subclasses, and contained
  objects; otherwise properties, registries, resource callbacks, or result
  handles may remain uninitialized. Preserve the order of parent and child
  initialization.
- **Removed array iteration APIs:** Replace `each()` loops with `foreach`
  when iterating arrays. Preserve keys, references, and ordering only where
  the code depends on them. If legacy code intentionally advances an array
  pointer, use `current()`/`next()` with care and test the behavior.
- **Removed string-offset syntax:** Replace curly-brace string offsets with
  square-bracket offsets.
- **`count()` input:** Ensure values passed to `count()` are arrays or
  `Countable`. For nullable cached state, initialize it to the correct
  collection type at construction rather than masking a broken initialization
  with an unrelated default.
- **Static calls:** If code calls a method statically, make the method static
  only when it does not use instance state. Otherwise create/use an instance
  and update the call site.
- **Control flow:** Replace invalid `continue` statements outside a loop or
  switch with the intended return, break, or other control flow. Use
  `continue 2` only when continuing the outer loop is the intended behavior.
- **Removed regular-expression `/e` modifier:** Replace `preg_replace(...e)`
  with `preg_replace_callback()`. Preserve the old replacement semantics,
  including escaping and newline handling, and test representative inputs.
- **Bundled template engines and libraries:** Treat vendored dependencies as
  application code during compatibility work. Ensure their constructors and
  callbacks run on the target PHP version. Verify that custom resource
  handlers register and that real templates compile and render; merely
  returning HTTP 200 is not sufficient if the response contains template
  errors.

Do not make `count()` warnings, deprecations, or other errors disappear by
silencing them globally. Fix the source of the invalid state or incompatible
operation.

## 5. Configure the web server and writable paths

- Set a global server name in the web-server image to suppress a missing
  fully-qualified-domain-name warning when a stable public name is not
  available inside the container.
- Explicitly make required cache, compiled-template, session, upload, and
  temporary directories writable by the web-server user. Apply ownership to
  the directories themselves as well as their existing contents, so empty
  directories also have usable permissions.
- Avoid broad permission changes such as making the whole application
  world-writable.

## 6. Validate the complete deployment

1. Run syntax checks on changed PHP files using the target PHP major version.
2. Validate the rendered Compose configuration with deployment variables set.
3. Build the image and recreate only the application service when appropriate.
4. Confirm the database is healthy and verify the required schema/tables exist
   using the application database account.
5. Request the application locally and inspect the rendered response, not
   just the HTTP status. Check that expected page content appears and template
   errors do not.
6. Review application and database logs for fatals, warnings, and startup
   failures after the first request.
7. Test important secondary paths (for example, login, administration,
   menus, search, uploads, and mail) because legacy incompatibilities often
   appear after the initial page renders.
8. For production, deploy only after the backup, restore/migration, and
   rollback approach have been verified.

Work iteratively: each newly exposed error may indicate another compatibility
issue. Fix the underlying cause, rebuild the image, and repeat the end-to-end
checks rather than suppressing the error or assuming that the first successful
response completes the migration.
