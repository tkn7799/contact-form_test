@extends('layouts.app')

@section('title', 'お問い合わせ内容の確認')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
  <h2 class="confirm__title">Confirm</h2>

  <form action="{{ route('contacts.send') }}" method="post" class="confirm__form">
    @csrf
    <table class="confirm-table">
      <tr>
        <th>お名前</th>
        <td>
          {{ $inputs['last_name'] }} {{ $inputs['first_name'] }}
          <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
          <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        </td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          {{ $inputs['gender_name'] }}
          <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>
          {{ $inputs['email'] }}
          <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        </td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>
          {{ $inputs['tel'] }}
          <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
        </td>
      </tr>
      <tr>
        <th>住所</th>
        <td>
          {{ $inputs['address'] }}
          <input type="hidden" name="address" value="{{ $inputs['address'] }}">
        </td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>
          {{ $inputs['building'] }}
          <input type="hidden" name="building" value="{{ $inputs['building'] }}">
        </td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>
          {{ $inputs['category_name'] }}
          <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
        </td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>
          {!! nl2br(e($inputs['message'])) !!}
          <input type="hidden" name="message" value="{{ $inputs['message'] }}">
        </td>
      </tr>
    </table>

    <div class="confirm-buttons">
      <button type="submit" name="action" value="send" class="confirm__button confirm__button--send">送信</button>
      <button type="submit" name="action" value="back" class="confirm__button confirm__button--back">修正</button>
    </div>
  </form>
</div>
@endsection
