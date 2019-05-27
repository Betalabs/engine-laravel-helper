<?php

namespace Betalabs\LaravelHelper\Console\Commands\App;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Laravel\Passport\Client;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy the application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->migrations();
        $this->createPassportClient();
        $this->call('queue:restart');

        if ($this->isNoChangeEnv()) {
            $this->call('config:cache');
            $this->call('route:cache');
        } else {
            $this->call('db:seed');
        }
    }

    /**
     * Define if environment should not be databased freshed
     *
     * @return bool
     */
    private function isNoChangeEnv(): bool
    {
        return App::environment(['sandbox', 'production']);
    }

    /**
     * Create a new Passport OAuth Client
     */
    private function createPassportClient(): void
    {
        if (Client::where('personal_access_client', 1)->exists()) {
            return;
        }

        $this->call('passport:install');
        $this->call('passport:keys');
        $this->call('passport:client', [
            '--personal' => true,
            '--name' => config('app.name') . ' Personal Access Client'
        ]);
    }

    /**
     * Run the migrations
     */
    private function migrations(): void
    {
        if ($this->isNoChangeEnv()) {
            $this->call('migrate', ['--force' => true]);
        } else {
            $this->call('migrate:fresh');
        }
    }
}