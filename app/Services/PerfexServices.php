<?php

namespace App\Services;

use App\Constants\PerfexConstants;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PerfexServices
{
    public function getAllInvoices( int $limit = 10000, int $limitStart = 0): ?Collection
    {

        $params = [
            PerfexConstants::$HEADER_AUTH_TOKEN    => PerfexConstants::$AUTH_TOKEN,
        ];

        $response = Http::withHeaders($params)
            ->get(
                PerfexConstants::$WEBOUT_PERFEX_URL . PerfexConstants::$PAYMENT_URL,
            );

        if(! $response->ok()) {
            return collect();
        }

        return collect(json_decode($response->body(), true));
    }

    public function getAllClients(int $limit = 100, int $limitStart = 0): ?Collection
    {

        $params = [
            'action'    => 'GetClients',
            'username'  => WhmcsConstants::$IDENTIFIER,
            'password'  => WhmcsConstants::$SECRET_KEY,
            'orderby'   => 'id',
            'order'     => 'desc',
            'limitnum'  => $limit,
            'limitstart' => $limitStart,
            'responsetype' => 'json',
        ];

        $response = Http::asForm()
            ->post(
                WhmcsConstants::$WEBOUT_WHMCS_URL . '?accesskey=' . WhmcsConstants::$ACCESS_KEY,
                $params
            );

        if(! $response->ok()) {
            return collect();
        }

        return collect(json_decode($response->body(), true));
    }
}
