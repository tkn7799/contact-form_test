@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@section('title', 'お問い合わせありがとうございます')

@section('content')
<div class="thanks">
  <div class="thanks__bg-text">Thank you</div>

  <div class="thanks__content">
    <p class="thanks__message">お問い合わせありがとうございました</p>
    <a href="{{ route('contacts.form') }}" class="thanks__button">HOME</a>
  </div>
</div>
@endsection
