@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="product">
    <div class="product__header">
        <h2 class="product__header-heading">商品一覧</h2>
        <a class="product__header-link" href="/products/register">＋ 商品を追加</a>
    </div>
    <div class="product__inner">
        <form class="search-form" action="/products/search" method="GET">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索" value="{{request('keyword')}}">
            <div class="search-form__action">
                <input class="search-form__search-btn btn" type="submit" value="検索">
            </div>
            <div class="search-form__order">
                <span class="search-form__order-label">価格順で表示</span>
                <div class="search-form__order-inner">
                    <select class="search-form__order-select" name="price">
                        <option disabled selected>価格で並べ替え</option>
                        <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>高い順</option>
                        <option value="asc" {{ request('price') == 'desc' ? 'selected' : '' }}>低い順</option>
                    </select>
                </div>
                <div class="filter">
                @if (request('price'))
                    <div class="filter-tag">
                        <span>{{ request('price') == 'desc' ? '高い順' : '低い順' }}に表示</span>
                        <a class="filter-tag__remove" href="/products" >×</a>
                    </div>
                @endif
                </div>
            </div>
        </form>

        <div class="product-card">
            @foreach ($products as $product)
            <div class="product-card__inner">
                <div class="product-card__group">
                    <a class="product-card__link" href="products/{{$product->id}}">
                        <div class="product-card__img">
                            <img src="{{asset('storage/'.$product->image)}}" alt="" >
                        </div>
                        <div class="product-card__content">
                            <div class="product-card__content-name">{{$product->name}}</div>
                            <div class="product-card__content-price">¥{{$product->price}}</div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $products->links('vendor.pagination.custom')}}
        </div>
    </div>
</div>
@endsection