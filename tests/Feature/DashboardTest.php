<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $tenant = \App\Models\Tenant::factory()->create(['onboarding_completed' => true]);
    $user = User::factory()->create(['tenant_id' => $tenant->id]);

    $this->actingAs($user);

    $this->get(route('dashboard'))->assertOk();
});
