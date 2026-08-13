<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonteService{

    protected string $token;
    protected string $endpoint = 'https://api.fonnte.com/send';

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    public function sendMassage($nomor,$pesan): array{
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post($this->endpoint,[
            "target" => $nomor,
            "message" => $pesan,
        ]);


        $result = $response->json();


        if (!$result["status"] ?? false){
            dd([
                "tes" => $nomor
            ]);
            Log::error("gagal kirim wa nya bos", [
                "nomor" => $nomor,
                "respon" => $result
            ]);
        }

        return $result;
    }
}