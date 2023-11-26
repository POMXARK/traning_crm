<?php
// Права доступа
return [
    [
        'key'   => 'contacts',
        'name'  => 'admin::app.acl.clients',
        'route' => 'admin.contacts.clients.index',
        'sort'  => 6,
    ],
     [
        'key'   => 'contacts.clients',
        'name'  => 'admin::app.acl.clients',
        'route' => 'admin.contacts.clients.index',
        'sort'  => 1,
    ],
 [
        'key'   => 'contacts.clients.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.contacts.clients.create', 'admin.contacts.clients.store'],
        'sort'  => 2,
    ], [
        'key'   => 'contacts.clients.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.contacts.clients.edit', 'admin.contacts.clients.update'],
        'sort'  => 3,
    ], [
        'key'   => 'contacts.clients.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.contacts.clients.delete', 'admin.contacts.clients.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'contacts.clients.export',
        'name'  => 'admin::app.acl.export',
        'route' => 'ui.datagrid.export',
        'sort'  => 4,
    ], 

    [
        'key'   => 'settings',
        'name'  => 'admin::app.acl.settings',
        'route' => 'admin.settings.index',
        'sort'  => 8,
    ], [
        'key'   => 'settings.user',
        'name'  => 'admin::app.acl.user',
        'route' => ['admin.settings.groups.index', 'admin.settings.roles.index', 'admin.settings.users.index'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups',
        'name'  => 'admin::app.acl.groups',
        'route' => 'admin.settings.groups.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.groups.create', 'admin.settings.groups.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.groups.edit', 'admin.settings.groups.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.groups.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.groups.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.user.roles',
        'name'  => 'admin::app.acl.roles',
        'route' => 'admin.settings.roles.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.roles.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.roles.create', 'admin.settings.roles.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.roles.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.roles.edit', 'admin.settings.roles.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.roles.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.roles.delete',
        'sort'  => 3,
    ],  [
        'key'   => 'settings.user.users',
        'name'  => 'admin::app.acl.users',
        'route' => 'admin.settings.users.index',
        'sort'  => 3,
    ], [
        'key'   => 'settings.user.users.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.users.create', 'admin.settings.users.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.users.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.users.edit', 'admin.settings.users.update', 'admin.settings.users.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.users.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.users.delete', 'admin.settings.users.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead',
        'name'  => 'admin::app.acl.lead',
        'route' => ['admin.settings.pipelines.index', 'admin.settings.sources.index', 'admin.settings.types.index'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.pipelines',
        'name'  => 'admin::app.acl.pipelines',
        'route' => 'admin.settings.pipelines.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.pipelines.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.pipelines.create', 'admin.settings.pipelines.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.pipelines.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.pipelines.edit', 'admin.settings.pipelines.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.pipelines.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.pipelines.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead.sources',
        'name'  => 'admin::app.acl.sources',
        'route' => 'admin.settings.sources.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.sources.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.sources.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.sources.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.sources.edit', 'admin.settings.sources.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.sources.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.sources.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead.types',
        'name'  => 'admin::app.acl.types',
        'route' => 'admin.settings.types.index',
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead.types.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.types.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.types.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.types.edit', 'admin.settings.types.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.types.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.types.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation',
        'name'  => 'admin::app.acl.automation',
        'route' => ['admin.settings.attributes.index', 'admin.settings.email_templates.index', 'admin.settings.workflows.index'],
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation.attributes',
        'name'  => 'admin::app.acl.attributes',
        'route' => 'admin.settings.attributes.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.attributes.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.attributes.create', 'admin.settings.attributes.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.attributes.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.attributes.edit', 'admin.settings.attributes.update', 'admin.settings.attributes.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.attributes.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.attributes.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation.email_templates',
        'name'  => 'admin::app.acl.email-templates',
        'route' => 'admin.settings.email_templates.index',
        'sort'  => 7,
    ], [
        'key'   => 'settings.automation.email_templates.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.email_templates.create', 'admin.settings.email_templates.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.email_templates.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.email_templates.edit', 'admin.settings.email_templates.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.email_templates.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.email_templates.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation.workflows',
        'name'  => 'admin::app.acl.workflows',
        'route' => 'admin.settings.workflows.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.workflows.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.workflows.create', 'admin.settings.workflows.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.workflows.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.workflows.edit', 'admin.settings.workflows.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.workflows.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.workflows.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.other_settings',
        'name'  => 'admin::app.acl.other-settings',
        'route' => 'admin.settings.tags.index',
        'sort'  => 4,
    ], [
        'key'   => 'settings.other_settings.tags',
        'name'  => 'admin::app.acl.tags',
        'route' => 'admin.settings.tags.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.other_settings.tags.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.tags.create', 'admin.settings.tags.store', 'admin.leads.tags.store'],
        'sort'  => 1,
    ], [ 
        'key'   => 'settings.other_settings.tags.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.tags.edit', 'admin.settings.tags.update'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.other_settings.tags.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.tags.delete', 'admin.settings.tags.mass_delete', 'admin.leads.tags.delete'],
        'sort'  => 2,
    ], [
        'key'   => 'configuration',
        'name'  => 'admin::app.acl.configuration',
        'route' => 'admin.configuration.index',
        'sort'  => 9,
    ]
];
