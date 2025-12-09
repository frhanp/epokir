<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestApiConnection extends Command
{
    /**
     * The name and signature of the console command.
     * Bisa input URL spesifik, atau default ke dummy API.
     *
     * @var string
     */
    protected $signature = 'app:test-api {url? : The full URL to test} {--method=GET : HTTP Method (GET, POST)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check HTTP connection to an external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Default URL ke JSONPlaceholder jika user tidak input URL
        $url = $this->argument('url') ?? 'https://jsonplaceholder.typicode.com/todos/1';
        $method = strtoupper($this->option('method'));

        $this->info("🔄 Testing {$method} connection to: [ {$url} ]");

        try {
            $startTime = microtime(true);
            
            // Lakukan Request dengan timeout 10 detik
            $response = Http::timeout(10)->send($method, $url);
            
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            if ($response->successful()) {
                $this->info("✅ SUCCESS");
                $this->line("Status Code : " . $response->status());
                $this->line("Duration    : {$duration} ms");
                $this->line("Response    : " . \Illuminate\Support\Str::limit($response->body(), 150));
            } else {
                $this->error("⚠️  FAILED (Client/Server Error)");
                $this->line("Status Code : " . $response->status());
                $this->line("Response    : " . \Illuminate\Support\Str::limit($response->body(), 150));
            }

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            $this->error("❌ CONNECTION ERROR (Network/DNS/Timeout)");
            $this->line("Details: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->error("❌ SYSTEM ERROR");
            $this->line("Details: " . $e->getMessage());
        }
    }
}