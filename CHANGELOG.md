# Changelog

## [0.4.3] - 2022-11-13

### Fixed

- Don't throw `RequestException` after retries.

## [0.4.2] - 2022-09-06

### Fixed

- Ignore Telescope requests in middleware.

## [0.4.1] - 2022-08-06

### Fixed

- Ignore Livewire requests in middleware.

## [0.4.0] - 2022-07-17

### Changed

- Ignore redirects in middleware.

## [0.3.2] - 2022-07-17

### Fixed

- Fix required Laravel version.

## [0.3.1] - 2022-07-02

### Changed

- Always send request after response.

## [0.3.0] - 2022-07-02

### Added

- Tracking events.

### Changed

- Retry failed request.

## [0.2.2] - 2022-07-02

### Changed

- No longer send `cf_connecting_ip`, `x_forwarded_for`, `forwarded` and `x_real_ip` headers.

## [0.2.1] - 2022-06-16

### Removed

- Hostname.

## [0.2.0] - 2022-06-14

### Removed

- Honor DNT.

## [0.1.2] - 2022-06-14

### Added

- Hostname.

## [0.1.1] - 2022-06-14

### Added

- Forwarded header.

### Fixed

- X-Real-IP header.

## [0.1.0] - 2022-06-12

### Added

- TrackPageview middleware.

[0.4.3]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.4.3
[0.4.2]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.4.2
[0.4.1]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.4.1
[0.4.0]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.4.0
[0.3.2]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.3.2
[0.3.1]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.3.1
[0.3.0]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.3.0
[0.2.2]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.2.2
[0.2.1]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.2.1
[0.2.0]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.2.0
[0.1.2]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.1.2
[0.1.1]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.1.1
[0.1.0]: https://github.com/pirsch-analytics/laravel-pirsch/releases/tag/0.1.0
