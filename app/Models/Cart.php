<?php

namespace App\Models;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $totalDiscount_price = 0;
    public $totalPurePrice = 0;
    public $couponDiscount = null;
    public $coupon = null;


    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalPurePrice = $oldCart->totalPurePrice;
            $this->totalDiscount_price = $oldCart->totalDiscount_price;
        }

    }

    public function add($item, $id)
    {
        if ($item->discount_price) {
            $storedItems = ['qty' => 0, 'price' => $item->discount_price, 'item' => $item];
        } else {
            $storedItems = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        }
        $storedItems = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItems = $this->items[$id];
            }
        }
        $storedItems['qty']++;
        if ($item->discount_price) {
            $storedItems['price'] = $item->discount_price * $storedItems['qty'];
            $this->totalPrice += $item->discount_price;
            $this->totalDiscount_price += ($item->price - $item->discount_price);

        } else {
            $storedItems['price'] = $item->price * $storedItems['qty'];
            $this->totalPrice += $item->price;

        }
        $this->items[$id] = $storedItems;
        $this->totalQty++;
        $this->totalPurePrice += $item->price;


    }

    public function remove($item, $id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                if ($item->discount_price) {
                    $this->items[$id]['price'] -= $item->discount_price;
                    $this->totalPrice -= $item->discount_price;
                    $this->totalDiscount_price -= ($item->price - $item->discount_price);
                } else {
                    $this->items[$id]['price'] -= $item->price;
                    $this->totalPrice -= $item->price;

                }
                $this->totalQty--;
                $this->totalPurePrice -= $item->price;
                if ($this->items[$id]['qty'] > 1) {
                    $this->items[$id]['qty']--;
                }else{
                    unset($this->items[$id]);
                }


            }
        }

    }

    public function addCoupon($coupon)
    {
        $couponData = ['price' => $coupon->price, 'coupon' => $coupon];
        $this->coupon =$couponData;
        $this->totalPrice -= $couponData['price'];
        $this->couponDiscount += $couponData['price'];
    }
}
