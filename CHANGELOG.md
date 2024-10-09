# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v0.46.0] - 09.10.2024

### Added

- Households' and HouseholdMembers' data tables save fields' sort information after change route.

### Fixed

### Changed

### Removed


## [v0.45.0] - 06.10.2024

### Added

### Fixed

- Fix bug when searching in DataTable (Dictionary, SystemDictionary, Households, HouseholdMembers)

### Changed

### Removed



## [v0.44.0] - 19.09.2024

### Added

### Fixed

- Fix bug with '\\' symbol in model name in SQL query for additional parameters for Households and HouseholdMembers

### Changed

### Removed

## [v0.43.0] - 25.07.2024

### Added

- Sort data by household member's birthdate.
- Death date field available in fields for export data.
- Clear selected fields button in ExportData form.

### Fixed

- Previously exported data was sorted by ID when querying the database, regardless of the sort order. 
  Now it sorting in appropriate way.  

### Changed

### Removed

