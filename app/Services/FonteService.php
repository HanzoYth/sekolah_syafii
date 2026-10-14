<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FonteService{

    protected ?string $token = null;
    protected string $endpoint = 'https://api.fonnte.com/send';

    public function __construct()
    {
        $this->token = config('services.fonnte.token') ?? '';
    }

    public function sendMassage($nomor,$pesan): array{
        if (empty($this->token)) {
            Log::info("FonteService: Token Fonnte tidak tersedia, pengiriman WhatsApp dilewati.", [
                "nomor" => $nomor
            ]);
            return ["status" => false, "reason" => "Token not configured"];
        }

        try {
            $response = Http::timeout(5)->withHeaders([
                'Authorization' => $this->token,
            ])->post($this->endpoint,[
                "target" => $nomor,
                "message" => $pesan,
            ]);

            $result = $response->json();

            if (!$result["status"] ?? false){
                Log::error("gagal kirim wa nya bos", [
                    "nomor" => $nomor,
                    "respon" => $result
                ]);
            }

            return $result ?? ["status" => false];
        } catch (\Throwable $e) {
            Log::warning("FonteService exception: " . $e->getMessage(), [
                "nomor" => $nomor
            ]);
            return ["status" => false, "reason" => $e->getMessage()];
        }
    }
}