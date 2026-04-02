<?php

namespace App\Listeners;

use App\Models\Post;
use App\Models\ShoppingCart;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Arr;

class LoginSuccessful
{
    public function __construct()
    {
        //
    }

    public function handle(Login $event): void
    {
        $cart = ShoppingCart::where('user_id', auth()->id())->get();
        foreach ($cart as $c) {
            $this->add($c->post, $c->count);
        }
    }

    public function add(Post $post, $count = 1)
    {
        $cart = session('cart', []);

        // add
        if (Arr::exists($cart, $post->id)) {
            $cart[$post->id][1] = $count;
        } else {
            $cart[$post->id] = [$post, $count];
        }
        // set en la sesion
        session(['cart' => $cart]);
    }
}
