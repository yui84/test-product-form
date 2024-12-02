@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="show">
    <form class="update-form" action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="update-form__inner">
            <div class="update-form__header">
                <span class="update-form__header-span">商品一覧</span> > {{$product->name}}
            </div>
            <div class="update-form__item">
                <div class="update-form__inputs">
                    <div class="update-form__image">
                        <img src="{{asset('storage/'.$product->image)}}" alt="" >
                        <input class="update-form__input-image" type="file" id="image" name="image">
                        <p class="update-form__error-message">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="update-form__group">
                        <div class="update-form__name">
                            <label class="update-form__label" for="name">商品名</label>
                            <input class="update-form__input" type="text" name="name" value="{{$product->name}}" placeholder="商品名を入力">
                            <p class="update-form__error-message">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="update-form__price">
                            <label class="update-form__label" for="price">値段</label>
                            <input class="update-form__input" type="text" name="price" value="{{$product->price}}" placeholder="値段を入力">
                            <p class="update-form__error-message">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="update-form__season">
                            <label class="update-form__label" for="">季節</label>
                            <div class="update-form__season-inputs">
                                @foreach ($seasons as $season)
                                <div class="update-form__season-select">
                                    <input class="update-form__season-input" type="checkbox" id="season_{{$season->id}}" name="seasons[]" value="{{ $season->id }}"
                                        {{ $product->seasons->contains($season->id) ? 'checked' : ''}}>
                                    <label class="update-form__season-label" for="season_{{$season->id}}">{{ $season->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            <p class="update-form__error-message">
                                @error('seasons')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                    </div>
                </div>
                <div class="update-form__text">
                    <label class="update-form__text-label" for="name">商品説明</label>
                    <textarea name="description" id="" cols="30" rows="10" class="update-form__textarea" placeholder="商品の説明を入力">{{$product->description}}</textarea>
                    <p class="update-form__error-message">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="update-form__btn-inner">
                    <a class="update-form__back" href="/products">戻る</a>
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input class="update-form__send-btn btn" type="submit" value="変更を保存">
                </div>
            </div>
        </div>
    </form>
    <form class="delete-form" action="{{route('products.destroy', ['productId' => $product->id])}}" method="POST">
        @method('DELETE')
        @csrf
        <div class="delete-form__button">
            <button class="delete-form__button-submit" type="submit"></button>
        </div>
    </form>
</div>
@endsection