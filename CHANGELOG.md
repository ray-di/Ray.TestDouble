# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).

## [Unreleased]

## [0.2.0] - 2026-11-22

### Changed
- Require PHP 8.2 or later (was `^8.0`). Composer keeps resolving 0.1.0 on older PHP.
- `LoggerInterface::log()` and `Logger::log()` are typed `MethodInvocation<object>`; static analysis of callers may report differently.
- Test on PHP 8.2 to 8.6 with the shared ray-di workflows.

## [0.1.0] - 2022-10-04
- First release.

[Unreleased]: https://github.com/ray-di/Ray.TestDouble/compare/0.2.0...HEAD
[0.2.0]: https://github.com/ray-di/Ray.TestDouble/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/ray-di/Ray.TestDouble/releases/tag/0.1.0
