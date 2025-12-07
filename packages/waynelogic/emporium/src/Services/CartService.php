<?php namespace Waynelogic\Emporium\Services;

use Illuminate\Support\Facades\Cookie;
use Waynelogic\FilamentCms\Database\Traits\Singleton;
use Waynelogic\Emporium\Models\Cart;
use Waynelogic\Emporium\Models\Offer;

class CartService
{
    use Singleton;
    const string COOKIE_NAME = 'emporium_cart_id';

    const int|float COOKIE_EXPIRE = 60 * 60 * 24 * 30;

    public ?int $iCartId;
    public ?Cart $obCart;

    protected function init(): void
    {
        $this->iCartId = request()->cookie(static::COOKIE_NAME);
        if (!$this->iCartId) {
            $this->createNewCart();
        }
        $this->obCart = Cart::query()->find($this->iCartId);
    }

    public function getCart(): ?Cart
    {
        $obCart = Cart::query()->with('cart_lines.purchasable')->find($this->iCartId);
        return $obCart;
    }

    public function add(int $iOfferId, int $iQuantity): bool
    {
        $cartLine = $this->obCart->cart_lines()->firstOrNew(['purchasable_id' => $iOfferId, 'purchasable_type' => Offer::class]);
        $cartLine->quantity += $iQuantity;
        $cartLine->save();
        return true;
    }
    private function createNewCart(): void
    {
        $this->obCart = Cart::query()->create();
        Cookie::queue(static::COOKIE_NAME, $this->obCart->id, static::COOKIE_EXPIRE);
    }
}
