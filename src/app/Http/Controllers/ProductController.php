<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use App\Http\Requests\RegisterRequest;

class ProductController extends Controller
{

    //商品登録画面
    public function create()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    //登録機能
    public function store(RegisterRequest $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if($request->hasFile('image')){
            $file=$request->file('image')->store('images','public');
            $product->image=$file;
        }
        $product->save();

        $product->seasons()->attach($request->input('seasons'));

        return redirect ('/products');
    }

    //商品一覧画面
    public function index()
    {
        $products = Product::Paginate(6);
        return view('product', compact('products'));
    }

    //商品検索処理
    public function search(Request $request)
    {
        $query = Product::query();

        $query = $this->getSearchQuery($request, $query);

        $products = $query->paginate(6);

        return view('product', compact('products'));
    }

    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('price')) {
            if ($request->price === 'desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->price === 'asc') {
                $query->orderBy('price', 'asc');
            }
        }

        return $query;
    }

    //商品詳細画面
    public function show ($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();

        return view('show', compact('product', 'seasons'));
    }

    //更新処理
    public function update(RegisterRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if($request->hasFile('image')){
            $file=$request->file('image')->store('images','public');
            $product->image=$file;
        }

        $product->save();

        $product->seasons()->sync($request->input('seasons'));

        return redirect('/products');
    }

    //削除処理
    public function destroy(Request $request, $productId)
    {
        $product = Product::findOrFail($productId)->delete();

        return redirect('/products');
    }
}