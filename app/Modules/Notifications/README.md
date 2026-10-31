# Notifications module

Owns notification records, delivery status, failure handling, and the Brevo API
adapter. External requests must use HTTPS and the configured five-second timeout.

The module should expose an application-level contract so the Brevo adapter can
be replaced by a fake implementation in tests.

The current implementation records a notification attempt immediately after a
registration is stored. A failed Brevo request changes notification status only;
it does not roll back or invalidate the registration.
