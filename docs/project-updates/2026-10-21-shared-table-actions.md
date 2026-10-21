# Shared Table Actions

## Implemented

- Added a reusable `row-action-menu` Blade component for table row actions.
- Added the shared vertical ellipsis icon to the reusable icon component.
- Moved Users and Team actions into the first table column.
- Both tables now use the same fixed-position popup behavior on desktop and mobile.
- Edit uses the shared indigo action style.
- Delete uses the shared red action style and the existing confirmation flow.
- User deletion keeps its higher-risk typed `confirm` requirement inside the shared confirmation modal.
- Restore actions use the shared restore icon and confirmation metadata.
- Removed the Users-specific delete dialog and inline delete JavaScript.
- Updated the UI/UX memory bank with the table action placement and color rules.

## Follow-up fixes

- Shortened popup labels to `Edit` and `Delete` so row menus do not become unnecessarily wide.
- Portaled the popup to `document.body` before positioning to prevent table overflow and white-space layers from clipping or blocking menu actions.
- Team deletion now uses the same typed `confirm` requirement and shared confirmation modal as user deletion.

## Verification

- Full Laravel suite: 20 passed, 0 failed.
- Focused About/Admin suite: 18 passed, 0 failed.
- Blade compilation: passed.
- JavaScript syntax check: passed.
- Frontend build: passed.
- `git diff --check`: passed.
- Browser check confirmed the Users popup contains `Edit` and `Delete user`, and both tables expose row-specific action triggers.
- Final browser check confirmed the Users popup is attached to `BODY`, remains within the viewport, and displays the concise `Edit`/`Delete` labels.
