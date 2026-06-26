<?php
use Illuminate\Support\Facades\Route;

Route::get('members', fn() => response()->json(['message' => 'members']));
