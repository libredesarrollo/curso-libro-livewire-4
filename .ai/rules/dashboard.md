---
paths:
  - 'resources/views/pages/dashboard/**'
---

# Dashboard

## LaraGrid action names must be unique across scopes
LaraGrid Grid::assertActionsValid() requires unique Action::make() names across row actions, bulkActions() and toolbarActions(). Give bulk actions distinct names (e.g. 'deleteSelected') even when they perform a similar delete. Also: LaraGrid's 'authorize' accepts an ability string OR a closure; string abilities resolve via Gate::authorize so they must be real Gate abilities (policies map to e.g. 'viewAny'), not dotted 'model.ability' unless a Gate::define exists.
