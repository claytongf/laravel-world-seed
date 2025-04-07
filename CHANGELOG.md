# Changelog

## v1.1.2

- Fixed State - City HasMany relationship

**Full Changelog**: [v1.1.1...v1.1.2](https://github.com/claytongf/laravel-world-seed/compare/v1.1.1...v1.1.2)

## v1.1.1

- Fixed Country - State - City relationship

**Full Changelog**: [v1.1.0...v1.1.1](https://github.com/claytongf/laravel-world-seed/compare/v1.1.0...v1.1.1)

## v1.1.0

- Added airport support.
- Removed `world:seed` command. To seed the entire country database, use the `world:add-country` command without parameters.
- Added city/airport relationship.
- Added `ByIsoCode` scope to the `Country` model.
- Airport data is now imported from a CSV file.
- Added `list_airports_to_seed` option to the `world.php` config file.

**Full Changelog**: [v1.0.1...v1.1.0](https://github.com/claytongf/laravel-world-seed/compare/v1.0.1...v1.1.0)

## v1.0.1

- Removed `dd()` method.

**Full Changelog**: [v1.0.0...v1.0.1](https://github.com/claytongf/laravel-world-seed/compare/v1.0.0...v1.0.1)

## v1.0.0

- Initial stable release.
- Added `world:remove` command.
- Fixed `world:add` command.

**Full Changelog**: [v0.1.7...v1.0.0](https://github.com/claytongf/laravel-world-seed/compare/v0.1.7...v1.0.0)

## v0.1.7

- Migrated country translations to the new model translation feature. They are no longer stored in the JSON field of the `Country` model.
- Added support for MySQL and PostgreSQL.

**Full Changelog**: [v0.1.6...v0.1.7](https://github.com/claytongf/laravel-world-seed/compare/v0.1.6...v0.1.7)

## v0.1.6

- The `list_countries_to_seed` config option now defaults to `[]`.
- Copying JSON information files to the database root folder is no longer required.
- A `FileNotFoundException` is thrown if the JSON files do not exist.
- Added license file.
- Created changelog.
- Updated documentation.

**Full Changelog**: [v0.1.5...v0.1.6](https://github.com/claytongf/laravel-world-seed/compare/v0.1.5...v0.1.6)

## v0.1.5

- Used `DIRECTORY_SEPARATOR` in the service provider to avoid issues.

**Full Changelog**: [v0.1.4...v0.1.5](https://github.com/claytongf/laravel-world-seed/compare/v0.1.4...v0.1.5)

## v0.1.4

- Fixed service provider registration.
- Updated namespaces.

## v0.1.3

- Updated namespaces.

## v0.1.2

- Added support for Laravel 11 and 12.

## v0.1.1

- Testing version

## 0.1.0

- Initial pre-release version for testing.
