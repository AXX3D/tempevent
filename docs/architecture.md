# TempEvent Application Architecture

TempEvent is organized by business capability. Each module owns its application
logic, HTTP entry points, persistence concerns, and tests. Shared code is kept
small and must not become a dumping ground for feature-specific behavior.

## Module boundaries

- `app/Modules/Events` — event creation, publishing, availability, and browsing.
- `app/Modules/Registrations` — participant registration and validation.
- `app/Modules/Notifications` — notification records and the Brevo adapter.
- `app/Shared` — cross-cutting contracts, exceptions, and reusable support only.

## Recommended module layout

```text
app/Modules/<Module>/
├── Actions/         # One application use case per class
├── Data/            # Explicit input/output objects when a use case needs them
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
├── Models/          # Eloquent models owned by the module
├── Policies/
├── Services/        # Integrations and orchestration that do not belong in controllers
└── Tests/            # Module-specific tests, when practical
```

## Dependency rules

1. Controllers validate and delegate; they do not contain business workflows.
2. Registrations may depend on Events to validate an event reference.
3. Registrations may request Notifications, but notification failure must not
   invalidate a stored registration.
4. The Brevo HTTP client belongs only in Notifications and must use the configured
   five-second timeout.
5. Secrets are read from configuration and never hard-coded.
6. Cross-module communication should use an action, contract, or domain event
   rather than reaching into another module's internal classes.

## Development workflow

Keep migrations, tests, and documentation with the module they support where
possible. Use small focused pull requests, and add or update tests whenever a
module contract changes.
