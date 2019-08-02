<?php
namespace App;

use App\Http\Controllers\TransactionController;
<<<<<<< HEAD
use App\Jobs\ProcessInvoice;
use App\Jobs\ProcessTransaction;
=======
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
use App\Order;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \DB;

class Helper
{

    /**
     * @param $data
     * @param string $error_message
     * @param int $code
     * @param $data
     * @return \Illuminate\Http\Response
     */

    public static function responseJson($data = [], $error_message, int $code)
    {
        $body = [

            'message' => $error_message,
        ];
        if ($code == 200) {
            $body['status'] = true;
            if (is_array($data)) {
                if (count($data) == 0 || ($data == null)) {
                    $body['message'] = 'data not found';
                    $body['status'] = false;
                    $body['error'] = 'invalid request parameter';
                    $code = 400;
                } else {
                    $body['data'] = $data;
                }
            } else {
                $body['data'] = $data;
            }

        } else {
            $body['status'] = false;
            $body['error'] = $data;
        }

        return response($body, $code);
    }
    public static function array_to_object(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::array_to_object($value);
            }
        }
        return (object) $array;
    }

    /**
     * @param object $errors
     * @param $message
     * @param int $code
     */

    public static function invalidRequest($errors, $message, $code = 400)
    {

        return self::responseJson($errors, $message, $code);
    }
    /**
     * @param object $data
     * @param $message
     * @param int $code
     */

    public static function validRequest($data, $message = 'Ok', $code = 200)
    {

        return self::responseJson($data, $message, 200);
    }

    public static function buildData($data, $total = 0)
    {
        $page = request()->query('page', 1);
        // $pageSize = request()->query('pageSize') == 0 ? $total : request()->query('pageSize');

        $data = [
            "item" => $data,
            "page" => (int) $page,
            "total" => $total,
        ];

        return $data;
    }
    public static function checkBooleanParameter($boolean)
    {

        if ($boolean == "true") {
            return 1;
        } else if ($boolean == "false") {
            return 0;
        } else if ($boolean > 1 || $boolean < 0 || !is_numeric($boolean)) {
            return Helper::inValidRequest('wrong parameter: sent parameter value must be boolean', 'Bad Request', 400);
            //throw new Exception("wrong parameter: sent parameter value must be boolean");

        } else {
            return $boolean;
        }
    }

    public static function createInvoice($orderPurchaseId, $type)
    {

        try {
            if ($type == 'order') {
                $order = Order::find($orderPurchaseId);
                $invoice['type'] = $type;
                $invoice['order_id'] = $orderPurchaseId;
                $invoice['user_id'] = $order->user_id;
                $invoice['amount'] = $order->amount;
<<<<<<< HEAD
                $invoice['cost'] = $order->cost;

                $invoice = Invoice::create($invoice);
                ProcessInvoice::dispatch();

                static::createTransaction($invoice);
=======

                $invoice_order = Invoice::where('order_id', $orderPurchaseId);
                if ($invoice_order->count() != 0) {

                    $invoice_order->first()->update($invoice);
                } else {
                    Invoice::create($invoice);

                }
                $invoice_created = Invoice::find($invoice_order->first()->id);

                static::createTransaction($invoice_created);
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b

                DB::commit();
                return true;

            } else {
                $purchase = Purchase::find($orderPurchaseId);
                $invoice['type'] = $type;
                $invoice['purchase_id'] = $orderPurchaseId;
                $invoice['user_id'] = $purchase->user_id;
                $invoice['amount'] = $purchase->amount;
<<<<<<< HEAD
                $invoice['cost'] = $purchase->amount;

                $invoice = Invoice::create($invoice);
                ProcessInvoice::dispatch();

                static::createTransaction($invoice);
=======

                $invoice_purchase = Invoice::where('purchase_id', $orderPurchaseId);
                if ($invoice_purchase->count() != 0) {

                    $invoice_purchase->first()->update($invoice);
                } else {
                    Invoice::create($invoice);
                }
                $invoice_created = Invoice::find($invoice_purchase->first()->id);

                static::createTransaction($invoice_created);
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                DB::commit();
                return true;
            }

        } catch (Exception $bug) {
            DB::rollback();
            return $this->exception($bug, 'unknown error', 500);
        }

    }

    public static function createTransaction(Invoice $invoice)
    {

<<<<<<< HEAD
        try {
            $request = new Request(['invoice_id' => $invoice->id]);

            $transaction = new TransactionController;
            $transaction->store($request);
            ProcessTransaction::dispatch();
        } catch (Exception $bug) {
            DB::rollback();
            return $this->exception($bug, 'unknown error', 500);
        }
=======
        $request = new Request(['invoice_id' => $invoice->id]);

        $transaction = new TransactionController;
        $transaction->store($request);
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b

    }

    public static function userIsSuperAdmin()
    {

        if (!auth()->user()->activated || !auth()->user()->isSuperAdmin) {
            return false;
        } else {
            return true;
        }

    }

}
