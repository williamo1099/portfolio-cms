<?php

use Illuminate\Support\Facades\Route;

Route::get("/login", App\Livewire\Auth\Login::class)->name("login");

Route::middleware(['auth'])->group(function () {
    Route::get("/", App\Livewire\Home\Index::class)->name("home.index");

    Route::get("/projects", App\Livewire\Project\Index::class)->name("projects.index");
    Route::get("/projects/create", App\Livewire\Project\Create::class)->name("projects.create");
    Route::get("/projects/update/{project}", App\Livewire\Project\Update::class)->name("projects.update");

    Route::get("/curriculum-vitaes", App\Livewire\CurriculumVitae\Index::class)->name("curriculum-vitaes.index");

    Route::get("/mails", App\Livewire\Mail\Index::class)->name("mails.index");

    Route::get("/profile", App\Livewire\Profile\Index::class)->name("profile.index");
});
