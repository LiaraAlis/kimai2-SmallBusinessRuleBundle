# Changelog
## 2.2.0
Compatible with Kimai v2.45.0
- Adopts the invoice tax rates API introduced in Kimai 2.45.0 (kimai/kimai#5740).
  The tax row is now provided via `InvoiceTemplate::setTaxRates()` instead of
  relying on the removed template VAT handling, which broke invoice rendering
  on Kimai 2.41 and above.
- Raised the minimum Kimai version to 2.45.0. `InvoiceTemplate::setTaxRates()`
  does not exist before that release, so earlier versions cannot be supported.
- Added a `LICENSE` file (MIT, matching the license already declared in
  `composer.json`).
- Added a CI workflow running PHP syntax checks, `composer validate` and an
  XML well-formedness check of the translation catalogues.

## 2.1.0
Compatible with Kimai v2.7.0
- Fixes #10 which occurs starting with Kimai 2.7.0

## 2.0.1
Compatible with Kimai v2.0
- Added dutch translation

## 2.0.0
Compatible with Kimai v2.0
- Support for Kimai 2.0

## 1.0.2
Compatible with Kimai v1.24
- Another fix of invoice calculation (Invoice overview shows same values and projects for different clients)

## 1.0.1
Compatible with Kimai v1.24
- Fixed invoice calculation
- Added Croatian translation

## 1.0
Compatible with Kimai v1.24
- Initial release
