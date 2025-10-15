@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
  <div class="register__heading">
    <h2>Register</h2>
  </div>

  <div class="register__card">
    <form class="register__form" action="/register" method="post" novalidate>
      @csrf

      <div class="form__group">
        <label class="form__label">お名前</label>
        <input class="form__input" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
        @error('name')
          <p class="form__error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form__group">
        <label class="form__label">メールアドレス</label>
        <input class="form__input" type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        @error('email')
          <p class="form__error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form__group">
        <label class="form__label">パスワード</label>
        <input class="form__input" type="password" name="password" placeholder="例: coachtech1106">
        @error('password')
          <p class="form__error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form__button">
        <button class="form__button-submit" type="submit">登録</button>
      </div>
    </form>
  </div>
</div>
@endsection
