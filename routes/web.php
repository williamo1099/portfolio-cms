<?php

use Illuminate\Support\Facades\Route;

Route::get("/login", App\Livewire\Auth\Login::class)->name("login");

Route::middleware(['auth'])->group(function () {
    Route::get("/", App\Livewire\Home\Index::class)->name("home.index");
    Route::get("/projects", App\Livewire\Project\Index::class)->name("projects.index");
    Route::get("/projects/create", App\Livewire\Project\Create::class)->name("projects.create");
    Route::get("/projects/update/{project}", App\Livewire\Project\Update::class)->name("projects.update");
});
