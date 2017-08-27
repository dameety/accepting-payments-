<?php

namespace App\Http\Controllers;

use Session;
use Stripe\Charge;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_KEY'));
    }

    public function index()
    {
        return view('subscriptions.index');
    }

    public function create(Request $request)
    {
        //validate request
        try {
            Auth::user()->newSubscription('grape-shop')->create($request->stripe_token);
            //save other inputs to db
            //do some other stuffs
            return redirect()->route('subscription.success');

        } catch (Card $e) {
            $err  = $e->getJsonBody()['error'];
            Session::flash('cardError', $err['message']);
            return back();
        } catch (\Stripe\Error\InvalidRequest $e) {
            $err  = $e->getJsonBody()['error'];
            Session::flash('invalidRequest', $err['message']);
            return back();
        } catch (\Stripe\Error\ApiConnection $e) {
            $err  = $e->getJsonBody()['error'];
            Session::flash('apiConnectionError', $err['message']);
            return back();
        } catch (\Stripe\Error\Base $e) {
            Session::flash('generalError', 'There was an error processing your payment.');
            return back();
        };
    }

    public function success()
    {
        return view('subscriptions.success');
    }

    public function charge()
    {
        $charge = Charge::create(
            array(
                "amount" => $request->page_price,
                "source"  => $request->stripe_token,
                "currency" => "$request->page_currency",
                "description" => 'Charge for ' . $request->page_name,
                'receipt_email' => Auth::user()->email
            )
        );
    }
}
