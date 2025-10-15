@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Admin</h1>

    {{-- 検索フォーム --}}
    <form method="GET" action="{{ route('admin') }}" class="bg-light p-3 rounded shadow-sm mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="名前またはメールアドレス">
            </div>
            <div class="col-md-2">
                <select name="gender" class="form-select">
                    <option value="" disabled {{ request('gender') === null ? 'selected' : '' }}>性別</option>
                    <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="">お問い合わせの種類</option>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ request('type') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date" value="{{ request('date') }}" class="form-control" placeholder="年/月/日">
            </div>
            <div class="col-md-2 text-end d-flex gap-2">
                {{-- 検索ボタン --}}
                <button type="submit" class="btn btn-primary flex-fill">検索</button>
                {{-- リセットボタン（初期状態に戻す） --}}
                <a href="{{ route('admin') }}" class="btn btn-secondary flex-fill">リセット</a>
            </div>
        </div>
        <div class="export-pagination-wrapper">
            <a href="{{ route('admin.export', request()->query()) }}" class="btn btn-success btn-sm">エクスポート</a>
            <div>
                {{ $contacts->links('vendor.pagination.default') }}
            </div>
        </div>
    </form>

    {{-- 検索結果一覧 --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                            <td>{{ $contact->gender_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category_name }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailModal"
                                    data-id="{{ $contact->id }}"
                                    data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                                    data-email="{{ $contact->email }}"
                                    data-gender="{{ $contact->gender_name }}"
                                    data-phone="{{ $contact->tel }}"
                                    data-address="{{ $contact->address }}"
                                    data-building="{{ $contact->building ?? '' }}"
                                    data-type="{{ $contact->category_name }}"
                                    data-message="{{ $contact->detail }}"
                                    data-date="{{ $contact->created_at->format('Y-m-d H:i') }}">
                                    詳細
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">該当するデータがありません。</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 詳細モーダル --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        {{-- 閉じるボタン --}}
        <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="閉じる">×</button>

        {{-- 本文 --}}
        <div class="modal-body">
            <dl>
                <dt>お名前</dt>
                <dd id="modal-name"></dd>

                <dt>性別</dt>
                <dd id="modal-gender"></dd>

                <dt>メールアドレス</dt>
                <dd id="modal-email"></dd>

                <dt>電話番号</dt>
                <dd id="modal-phone"></dd>

                <dt>住所</dt>
                <dd id="modal-address"></dd>

                <dt>建物名</dt>
                <dd id="modal-building"></dd>

                <dt>お問い合わせの種類</dt>
                <dd id="modal-type"></dd>

                <dt>お問い合わせ内容</dt>
                <dd id="modal-message"></dd>
            </dl>
        </div>

      {{-- 削除ボタン --}}
      <div class="modal-footer">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- モーダルにデータを渡すスクリプト --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('detailModal');
    const deleteForm = document.getElementById('deleteForm');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');

        document.getElementById('modal-name').textContent = button.getAttribute('data-name');
        document.getElementById('modal-gender').textContent = button.getAttribute('data-gender');
        document.getElementById('modal-email').textContent = button.getAttribute('data-email');
        document.getElementById('modal-phone').textContent = button.getAttribute('data-phone');
        document.getElementById('modal-address').textContent = button.getAttribute('data-address');
        document.getElementById('modal-building').textContent = button.getAttribute('data-building') || '-';
        document.getElementById('modal-type').textContent = button.getAttribute('data-type');
        document.getElementById('modal-message').textContent = button.getAttribute('data-message');

        deleteForm.action = `/admin/${id}`;
    });
});
</script>

@endsection
