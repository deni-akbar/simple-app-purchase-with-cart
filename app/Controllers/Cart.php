<?php namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CartModel;
$db = \Config\Database::connect();

class Cart extends BaseController
{
	public function index()
	{
        $res=[];
        $CartModel = new CartModel();
        $cart = $CartModel->findAll();

        return view('cart/index', [
            'cart' => $cart,
            'errors' => []
        ]);
    }
    
    public function create($id)
    {
        helper('form');
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $product = $productModel->find($id);
        $cart=$cartModel->where('product_id',$id)->first();

        if($cart){
            $stock = [
                'stock' => $product->stock-=1
            ];
            $productModel->update($product->id, $stock);

            $json = [
                'quantity' => $cart->quantity+=1,
                'price' => $cart->price+=$product->price,
                'subtotal' => $cart->subtotal+=$product->price
            ];

            if($cartModel->update($cart->id, $json)){
                session()->setFlashdata('success', 'Data berhasil disimpan');
                return redirect()->to('/cart/index');
            }
        }else{
            $stock = [
                'stock' => $product->stock-=1
            ];
            $productModel->update($product->id, $stock);

            $cart = [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'subtotal' => $product->price
            ];
            
            if($cartModel->insert($cart)){
                session()->setFlashdata('success', 'Data berhasil disimpan');
                return redirect()->to('/cart/index');
            }
        }



        return view('cart/index');
    }

    public function plus($id)
    {
        helper('form');
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $cart=$cartModel->find($id);
        $product = $productModel->find($cart->product_id);

        if($product->stock==0){
            session()->setFlashdata('warning', 'Stok tidak mencukupi');
            return redirect()->to('/cart/index');
        }

        $stock = [
            'stock' => $product->stock-=1
        ];
        $productModel->update($product->id, $stock);

        $json = [
            'quantity' => $cart->quantity+=1,
            'price' => $cart->price+=$product->price,
            'subtotal' => $cart->subtotal+=$product->price
        ];

        if($cartModel->update($cart->id, $json)){
            session()->setFlashdata('success', 'Data berhasil ditambah');
            return redirect()->to('/cart/index');
        }



        return view('cart/index');
    }

    public function min($id)
    {
        helper('form');
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $cart=$cartModel->find($id);
        $product = $productModel->find($cart->product_id);

        $stock = [
            'stock' => $product->stock+=1
        ];
        $productModel->update($product->id, $stock);

        $json = [
            'quantity' => $cart->quantity-=1,
            'price' => $cart->price-=$product->price,
            'subtotal' => $cart->subtotal-=$product->price
        ];

        if($cartModel->update($cart->id, $json)){
            session()->setFlashdata('success', 'Data berhasil dikurang');
            return redirect()->to('/cart/index');
        }



        return view('cart/index');
    }

    public function checkout()
    {
        helper('form');

        $cartModel = new CartModel();
        if($cartModel->truncate()){
            session()->setFlashdata('success', 'Checkout Berhasil');
            return redirect()->to('/cart/index');
        }

    }
}
