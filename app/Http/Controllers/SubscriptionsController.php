<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index()
    {
        return view('subscriptions.index');
    }

    public function create(Request $request)
    {
        //validate request
        try {
            Auth::user()->newSubscription(grape-shop, 'monthly')->create($request->stripe_token);
            //save other inputs to db
            //do some other stuffs
            return redirect()->to('subscritption/success');

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
}
