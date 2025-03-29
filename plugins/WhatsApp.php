<?php

namespace Plugins;

class WhatsApp
{
    public static function send($number, $message, $image = false)
    {
        $api_key = env('WA_KEY'); // API KEY Anda
        $id_device = env('WA_DEVICE'); // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url = $image ? env('WA_URL').'/send-media' : env('WA_URL').'/send-message'; // URL API
        $no_hp = $number; // No.HP yang dikirim (No.HP Penerima)
        $pesan = $message; // Pesan yang dikirim
        $tipe = 'image'; // Tipe Pesan Media Gambar

        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_POST, 1);

            $data_post = [
                'id_device' => $id_device,
                'api-key' => $api_key,
                'no_hp' => $no_hp,
                'pesan' => $pesan,
            ];

            if ($image) {
                $data_post = array_merge($data_post, [
                    'tipe' => $tipe,
                    'link' => $image,
                ]);
            }

            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($curl);
            curl_close($curl);

            return $response;
        } catch (\Throwable $th) {
            $error = [
                'kode' => 500,
                'status' => false,
                'message' => [
                    $th->getMessage(),
                ],
            ];

            return $error;
        }
    }
}
