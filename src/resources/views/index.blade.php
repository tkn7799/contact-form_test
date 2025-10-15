@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<div class="contact-form">
  <h1 class="form__title">Contact</h1>

  <form class="form" action="/confirm" method="post">
    @csrf

    {{-- お名前 --}}
    <div class="form__group">
      <label class="form__label">お名前 <span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <div class="form__name-fields">
          <div class="form__name-field">
            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
            @error('last_name')<p class="error">{{ $message }}</p>@enderror
          </div>
          <div class="form__name-field">
            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
            @error('first_name')<p class="error">{{ $message }}</p>@enderror
          </div>
        </div>
      </div>
    </div>

    {{-- 性別 --}}
    <div class="form__group">
      <label class="form__label">性別 <span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <div class="form__radio">
          <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性</label>
          <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
          <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
        </div>
        @error('gender')<p class="error">{{ $message }}</p>@enderror
      </div>
    </div>

    {{-- メールアドレス --}}
    <div class="form__group">
      <label class="form__label">メールアドレス <span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
        @error('email')<p class="error">{{ $message }}</p>@enderror
      </div>
    </div>

    {{-- 電話番号 --}}
    <div class="form__group">
      <label class="form__label">電話番号 <span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <div class="form__tel-fields">
          <input type="text" name="tel1" maxlength="4" value="{{ old('tel1') }}" placeholder="080">
          <span class="form__tel-hyphen">-</span>
          <input type="text" name="tel2" maxlength="4" value="{{ old('tel2') }}" placeholder="1234">
          <span class="form__tel-hyphen">-</span>
          <input type="text" name="tel3" maxlength="4" value="{{ old('tel3') }}" placeholder="5678">
        </div>
        @error('tel')<p class="error">{{ $message }}</p>@enderror
      </div>
    </div>

    {{-- 住所 --}}
    <div class="form__group">
      <label class="form__label">住所 <span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
      @error('address')<p class="error">{{ $message }}</p>@enderror
      </div>
    </div>

    {{-- 建物名 --}}
    <div class="form__group">
      <label class="form__label">建物名</label>
      <div class="form__input-wrapper">
        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
      </div>
    </div>

    {{-- お問い合わせの種類 --}}
    <div class="form__group">
      <label class="form__label">お問い合わせの種類 <span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <select name="category_id" class="category-select">
          <option value="">選択してください</option>
          <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
          <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
          <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
          <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
          <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
        </select>
      @error('category_id')<p class="error">{{ $message }}</p>@enderror
      </div>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="form__group">
      <label class="form__label">お問い合わせ内容 <span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <textarea name="message" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('message') }}</textarea>
      @error('message')<p class="error">{{ $message }}</p>@enderror
      </div>
    </div>

    {{-- 送信ボタン --}}
    <div class="form__group form__button">
      <button type="submit">確認画面へ</button>
    </div>
  </form>
</div>
@endsection
