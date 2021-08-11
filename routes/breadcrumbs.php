<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Dashboard > Home
Breadcrumbs::for('dashboard_home', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '#');
});

// Dashboard > Categories
Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('categories.index'));
});

// Dashboard > Categories > Add
Breadcrumbs::for('add-category', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push('Add Category', route('categories.create'));
});

// Dashboard > Categories > Edit
Breadcrumbs::for('edit-category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push('Edit Category', route('categories.edit', ['category' => $category]));
});

// Dashboard > Categories > Edit > [Title]
Breadcrumbs::for('edit-category-title', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('edit-category', $category);
    $trail->push($category->title, route('categories.edit', ['category' => $category]));
});

// Dashboard > Categories > Detail
Breadcrumbs::for('detail-category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail Category', route('categories.show', ['category' => $category]));
});

// Dashboard > Categories > Detail > [Title]
Breadcrumbs::for('detail-category-title', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('detail-category', $category);
    $trail->push($category->title, route('categories.show', ['category' => $category]));
});
// Home > Blog
// Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });
