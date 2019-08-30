<?php

Breadcrumbs::for('sitetronic-user-admin-index', function ($trail) {
    $trail->parent('sitetronic-core-admin-index');
    $trail->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('sitetronic-user-admin-roles', function ($trail) {
    $trail->parent('sitetronic-user-admin-index');
    $trail->push('Roles', route('admin.roles.index'));
});

Breadcrumbs::for('sitetronic-user-admin-permissions', function ($trail) {
    $trail->parent('sitetronic-user-admin-index');
    $trail->push('Permissions', route('admin.permissions.index'));
});
