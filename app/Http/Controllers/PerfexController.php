<?php

namespace App\Http\Controllers;

use App\Constants\PerfexConstants;
use App\Models\Client;
use App\Models\Invoice;
use App\Services\WhmcsServices;
use Illuminate\Http\Request;
use App\Services\PerfexServices;

class PerfexController extends Controller
{
    public const PREFIX_PERFEX = 'per';
    function index(Request $request)
    {
        $perfexServices = new PerfexServices();
        $invoices = $perfexServices->getAllInvoices();

        if($invoices->isEmpty())
        {
            return response()->json();
        }

        foreach($invoices as $invoice){

            $keys = [
                'foreign_reference' => self::PREFIX_PERFEX . $invoice['id'],
            ];

            $attributes = array(
                'user_id'           => $invoice['clientid'],
                'first_name'         => '',
                'last_name'         => '',
                'company_name'      => '',
                'invoice_number'    => $invoice['prefix'] . $invoice['number'],
                'due_date'          => $invoice['duedate'] !== '0000-00-00' ? $invoice['duedate'] : null,
                'sub_total'         => $invoice['subtotal'],
                'tax'               => $invoice['total_tax'],
                'total'             => $invoice['total'],
                'status'            => PerfexConstants::INVOICE_STATUSES[$invoice['status']],
                'valid'             => 0,
                'payment_method'    => '',
                'payment_id'        => '',
                'notes'             => $invoice['adminnote'],
                'created_at'        => $invoice['datecreated'],
                'updated_at'        => $invoice['datecreated']
            );

            Invoice::updateOrInsert($keys, $attributes);
        }

        return response()->json($invoices);
    }

    public function getClients(Request $request)
    {
        $perfexServices = new PerfexServices();
        $clients = $perfexServices->getAllClients();
        dd($clients);
        if(! $clients->isEmpty())
        {
            foreach($clients->get('clients')['client'] as $client){

                $keys = [
                    'foreign_id' => $client['id']
                ];
                $attributes = [
                    'first_name' => $client['firstname'],
                    'last_name'  => $client['lastname'],
                    'company'    => $client['companyname'],
                    'email'      => $client['email'],
                    'status'     => mb_strtolower($client['status'])
                ];
                Client::updateOrInsert($keys, $attributes);
            }
        }
        return response()->json($clients->get('clients'));
    }
}
