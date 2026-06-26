<?php

namespace App\Console\Commands;

use App\Models\Deployment;
use Illuminate\Console\Command;

class RecordDeployment extends Command
{
    protected $signature = 'deploy:record {--commit= : The commit hash of the deployment}';

    protected $description = 'Record a successful deployment in the database';

    public function handle(): void
    {
        $hash = $this->option('commit') ?: trim(exec('git log -1 --format=%H 2>nul || echo unknown'));

        Deployment::create([
            'commit_hash' => $hash,
            'deployed_at' => now(),
            'status' => 'success',
        ]);

        $this->info("Deployment {$hash} recorded successfully.");
    }
}
