<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\WhmcsServices;

class WhmcsController extends Controller
{
    function index(Request $request)
    {
        $whmcsServices = new WhmcsServices();
        $invoices = $whmcsServices->getAllInvoices();

        if($invoices->isEmpty())
        {
            return response()->json();
        }

        foreach($invoices->get('invoices')['invoice'] as $invoice){
            $keys = [
                'foreign_id' => $invoice['id'],
            ];

            $attributes = array(
                'user_id'           => $invoice['userid'],
                'first_name'        => $invoice['firstname'],
                'last_name'         => $invoice['lastname'],
                'company_name'      => $invoice['companyname'],
                'invoice_number'    => $invoice['invoicenum'],
                'due_date'          => $invoice['duedate'] !== '0000-00-00' ? $invoice['duedate'] : null,
                'paid_date'         => $invoice['datepaid'] !== '0000-00-00 00:00:00' ? $invoice['datepaid'] : null,
                'cancelled_date'    => $invoice['date_cancelled'] !== '0000-00-00 00:00:00' ? $invoice['date_cancelled'] : null,
                'sub_total'         => $invoice['subtotal'],
                'credit'            => $invoice['credit'],
                'tax'               => $invoice['tax'],
                'tax2'              => $invoice['tax2'],
                'total'             => $invoice['total'],
                'tax_rate'          => $invoice['taxrate'],
                'tax_rate2'         => $invoice['taxrate2'],
                'status'            => $invoice['status'],
                'payment_method'    => $invoice['paymentmethod'],
                'payment_id'        => $invoice['paymethodid'],
                'notes'             => $invoice['notes'],
                'created_at'        => $invoice['created_at'],
                'updated_at'        => $invoice['updated_at']
            );

            Invoice::updateOrInsert($keys, $attributes);
        }

        return response()->json($invoices);
    }

    public function getClients(Request $request)
    {
        $whmcsServices = new WhmcsServices();
        $clients = $whmcsServices->getAllClients();

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
