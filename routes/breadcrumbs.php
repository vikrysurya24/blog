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

// Dashboard > Categories > Edit > [Title]
Breadcrumbs::for('edit-category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push('Edit Category', route('categories.edit', ['category' => $category]));
    $trail->push($category->title, route('categories.edit', ['category' => $category]));
});

// Dashboard > Categories > Detail > [Title]
Breadcrumbs::for('detail-category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail Category', route('categories.show', ['category' => $category]));
    $trail->push($category->title, route('categories.show', ['category' => $category]));
});

// Dashboard > Tags
Breadcrumbs::for('tags', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tags', route('tags.index'));
});

// Dashboard > Tags > Add
Breadcrumbs::for('add-tag', function (BreadcrumbTrail $trail) {
    $trail->parent('tags');
    $trail->push('Add Tag', route('tags.create'));
});

// Dashboard > Tags > Edit > [Title]
Breadcrumbs::for('edit-tag', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('tags');
    $trail->push('Edit Tag', route('tags.edit', ['tag' => $tag]));
    $trail->push($tag->title, route('tags.edit', ['tag' => $tag]));
});

// Dashboard > Posts
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Posts', route('posts.index'));
});

// Dashboard > Posts > Add
Breadcrumbs::for('add-post', function (BreadcrumbTrail $trail) {
    $trail->parent('posts');
    $trail->push('Add Post', route('posts.create'));
});

// Dashboard > Posts > Detail > [Title]
Breadcrumbs::for('detail-post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('posts');
    $trail->push('Detail Post', route('posts.show', ['post' => $post]));
    $trail->push($post->title, route('posts.show', ['post' => $post]));
});

// Dashboard > Posts > Edit > [Title]
Breadcrumbs::for('edit-post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('posts');
    $trail->push('Edit Post', route('posts.edit', ['post' => $post]));
    $trail->push($post->title, route('posts.edit', ['post' => $post]));
});

// Dashboard > File Manager
Breadcrumbs::for('file-manager', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('File Manager', route('filemanager.index'));
});
