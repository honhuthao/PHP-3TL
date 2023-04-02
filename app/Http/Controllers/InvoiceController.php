<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    function index(){
        $invoices = Invoice::all();
        return view('invoice.index', ['invoices' => $invoices]);
    }
    function checkout()
    {
        $cart = session()->get('cart');
        // check user has customer info
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->customer) {
                $customer = $user->customer;
                return view('invoice.checkout', ['cart' => $cart, 'customer' => $customer]);
            }
        }
        return view('invoice.checkout', ['cart' => $cart]);
    }

    function save(Request $request)
    {
        $address = $request->input('address');
        $phone = $request->input('phone');
        $note = $request->input('note');
        $saveInfo = $request->input('save_info');
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $invoice = new Invoice();
        $invoice->address = $address;
        $invoice->phone = $phone;
        $invoice->note = $note;
        $invoice->total = $total;
        $invoice->save();

        // if save_info is true, save customer info
        if ($saveInfo == "on") {
            $user = Auth::user();

            // if user has customer info, update it
            if ($user->customer) {
                $customer = $user->customer;
                $customer->address = $address;
                $customer->phone = $phone;
                $customer->save();
            } else {
                $customer = new Customer();
                $customer->address = $address;
                $customer->phone = $phone;
                $customer->user_id = $user->id;
                $customer->save();
            }
        }

        foreach ($cart as $item) {
            $invoice->products()->attach($item['id'], ['quantity' => $item['quantity'], 'price' => $item['price']]);
        }
        session()->forget('cart');
        return redirect()->route('invoice.success', ['id' => $invoice->id]);
    }

    function success(Request $request)
    {
        $id = $request->id;
        //return the invoice detail with pivot table
        $invoice = Invoice::find($id);
        return view('invoice.success', ['invoice' => $invoice]);
    }
}