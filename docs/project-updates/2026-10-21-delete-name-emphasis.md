# Delete Name Emphasis

## Changes

- Added the affected record name to shared row-action confirmation metadata.
- Rendered the Team or User name as bold red text inside the shared confirmation message.
- Kept the message and name safely rendered as DOM text rather than injecting HTML.

## Verification

- Added a feature assertion for the User confirmation name metadata.
- Existing typed confirmation, red danger styling, and delete handlers remain unchanged.
