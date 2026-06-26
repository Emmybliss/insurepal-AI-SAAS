<?php

use App\Models\Deployment;
use App\Models\User;

test('deployment can be created', function () {
    $deployment = Deployment::factory()->create([
        'commit_hash' => 'a7d41cf1234567890123456789012345678901234',
        'status' => 'success',
    ]);

    expect($deployment)->toBeInstanceOf(Deployment::class)
        ->and($deployment->commit_hash)->toBe('a7d41cf1234567890123456789012345678901234')
        ->and($deployment->status)->toBe('success');
});

test('deployment belongs to a user', function () {
    $user = User::factory()->create();
    $deployment = Deployment::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($deployment->user)->toBeInstanceOf(User::class)
        ->and($deployment->user->id)->toBe($user->id);
});

test('deploy:record command creates a deployment', function () {
    $this->artisan('deploy:record', ['--commit' => 'abc123def456'])
        ->expectsOutput('Deployment abc123def456 recorded successfully.')
        ->assertExitCode(0);

    $this->assertDatabaseHas('deployments', [
        'commit_hash' => 'abc123def456',
        'status' => 'success',
    ]);
});

test('deployment factory creates valid deployment', function () {
    $deployment = Deployment::factory()->create();

    expect($deployment->commit_hash)->not->toBeEmpty()
        ->and($deployment->status)->toBeIn(['success', 'failed', 'pending'])
        ->and($deployment->deployed_at)->not->toBeNull();
});

test('deployments are listed latest first', function () {
    $old = Deployment::factory()->create(['created_at' => now()->subDay()]);
    $new = Deployment::factory()->create(['created_at' => now()]);

    $latest = Deployment::latest()->get();

    expect($latest->first()->id)->toBe($new->id);
});
