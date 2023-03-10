<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setup(): void
    {
        parent::setup();

        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
    }
}
