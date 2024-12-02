@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading">商品登録</h2>
    <div class="register-form__inner">
        <form action="/products" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="name">
                    商品名<span class="register-form__required">必須</span>
                </label>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
                <p class="register-form__error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="price">
                    値段<span class="register-form__required">必須</span>
                </label>
                <input class="register-form__input" type="text" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
                <p class="register-form__error-message">
                    @error('price')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="filename">
                    商品画像<span class="register-form__required">必須</span>
                </label>
                <input class="register-form__input-image" id="image" type="file" name="image">
                <img id="preview">
                <p class="register-form__error-message">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="">
                    季節<span class="register-form__required">必須</span>
                    <span class="register-form__select">複数選択可</span>
                </label>
                <div class="register-form__season-inputs">
                    @foreach ($seasons as $season)
                    <div class="register-form__season-select">
                        <input class="register-form__season-input" type="checkbox" name="seasons[]" id="season_{{$season->id}}" value="{{ $season->id }}">
                        <label class="register-form__season-label" for="season_{{$season->id}}">
                        {{ $season->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <p class="register-form__error-message">
                    @error('seasons')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="description">
                    商品説明<span class="register-form__required">必須</span>
                </label>
                <textarea class="register-form__textarea" name="description" id="" cols="30" rows="10" placeholder="商品の説明を入力" >{{old('description')}}</textarea>
                <p class="register-form__error-message">
                    @error('description')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__btn-inner">
                <a class="register-form__back" href="/products">戻る</a>
                <input class="register-form__send-btn btn" type="submit" value="登録" name="send">
            </div>
        </form>
    </div>
</div>
@endsection