<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite; // 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // =================================================================
        // SOLUSI UNTUK VITEMANIFESTNOTFOUNDEXCEPTION DI SHARED HOSTING
        // =================================================================

        // Cek apakah aplikasi berjalan di environment produksi atau jika kita memaksa
        if ($this->app->environment('production') || env('FORCE_VITE_PATH', false)) {

            // Dapatkan jalur absolut ke folder 'public_html' (atau folder public Anda)
            // __DIR__ . '/../../public_html' mengasumsikan folder 'public_html' berada di root project
            $publicPath = realpath(__DIR__ . '/../../public_html');

            // Jika public_html tidak ada (misalnya di lokal), gunakan folder 'public' standar
            if (!$publicPath) {
                $publicPath = $this->app->basePath('public');
            }

            // Memaksa Vite untuk mencari manifest.json relatif terhadap jalur ini.
            Vite::usePublicPath($publicPath);

            // Opsional: Untuk debugging, Anda bisa log jalur yang digunakan
            // \Illuminate\Support\Facades\Log::info('Vite Public Path Forced To: ' . $publicPath);
        }
    }
}
