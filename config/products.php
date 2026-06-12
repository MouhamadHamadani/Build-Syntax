<?php

/*
|--------------------------------------------------------------------------
| Product Taxonomy — Single Source of Truth
|--------------------------------------------------------------------------
|
| The DB columns contact_submissions.project_type and
| portfolio_projects.category are plain VARCHAR(30); these lists are the
| application-level whitelist enforced by validation. Adding a product here
| (plus the relevant form/filter UI) is all that is needed — no schema
| migration required.
|
*/

return [
    'project_types' => ['website', 'ecommerce', 'appointment', 'pos', 'other'],
    'portfolio_categories' => ['web', 'ecommerce', 'pos', 'other'],
];
