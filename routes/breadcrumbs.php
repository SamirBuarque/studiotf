<?php 

use App\Models\EventRecord;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Workers;
use App\Models\Inventory;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Principal', route('index'));
});

Breadcrumbs::for('event.detail', function (BreadcrumbTrail $trail, $id) {
  $trail->parent('home');  
  $trail->push('Detalhamento', route('event.detail', $id));
});

Breadcrumbs::for('event.create', function (BreadcrumbTrail $trail) {
  $trail->parent('home');  
  $trail->push('Adicionar', route('event.create'));
});

Breadcrumbs::for('event.edit', function (BreadcrumbTrail $trail, EventRecord $eventRecord) {
  $trail->parent('event.detail', $eventRecord);  
  $trail->push('Editar', route('event.edit', $eventRecord));
});

Breadcrumbs::for('worker.index', function (BreadcrumbTrail $trail) {
  $trail->parent('home');  
  $trail->push('Funcionário', route('worker.index'));
});

Breadcrumbs::for('worker.create', function (BreadcrumbTrail $trail) {
  $trail->parent('worker.index');  
  $trail->push('Adicionar', route('worker.create'));
});

Breadcrumbs::for('worker.edit', function (BreadcrumbTrail $trail, Workers $worker) {
  $trail->parent('worker.index');  
  $trail->push('Editar', route('worker.edit', $worker));
});

Breadcrumbs::for('inventory.index', function (BreadcrumbTrail $trail) {
  $trail->parent('home');  
  $trail->push('Inventário', route('inventory.index'));
});

Breadcrumbs::for('inventory.edit', function (BreadcrumbTrail $trail, Inventory $inventory) {
  $trail->parent('inventory.index');  
  $trail->push('Editar', route('inventory.edit', $inventory));
});

Breadcrumbs::for('inventory.create', function (BreadcrumbTrail $trail) {
  $trail->parent('inventory.index');  
  $trail->push('Adicionar', route('inventory.create'));
});


