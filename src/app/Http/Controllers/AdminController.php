<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /**
     * 管理画面：検索フォーム + ページネーション表示
     */
    public function index(Request $request)
    {
        $query = Contacts::with('category');

        // キーワード検索（名前・メール）
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', "%{$request->keyword}%")
                  ->orWhere('first_name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        // 性別フィルター
        if ($request->filled('gender') && $request->gender !== '' && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせの種類フィルター
        if ($request->filled('type') && $request->type !== '') {
            $query->where('category_id', $request->type);
        }

        // 日付フィルター
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション前にデバッグ
//        dd($query->with('category')->first());
        // ページネーション
        $contacts = $query->orderBy('created_at', 'desc')->paginate(7)->appends($request->all());

        return view('admin', compact('contacts'));
    }

    /**
     * CSVエクスポート機能
     */
    public function export(Request $request): StreamedResponse
    {
        $response = new StreamedResponse(function () use ($request) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                '名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '登録日',
            ]);

            $query = Contacts::with('category');

            // 条件をCSV出力にも反映
            if ($request->filled('keyword')) {
                $query->where(function ($q) use ($request) {
                    $q->where('last_name', 'like', "%{$request->keyword}%")
                      ->orWhere('first_name', 'like', "%{$request->keyword}%")
                      ->orWhere('email', 'like', "%{$request->keyword}%");
                });
            }
            if ($request->filled('gender') && $request->gender !== '' && $request->gender !== 'all') {
                $query->where('gender', $request->gender);
            }
            if ($request->filled('type') && $request->type !== 'お問い合わせの種類') {
                $query->where('category_id', $request->type);
            }
            if ($request->filled('date')) {
                $query->whereDate('created_at', $request->date);
            }

            // データを100件ずつ書き出す
            $query->orderBy('created_at', 'desc')->chunk(100, function ($contacts) use ($handle) {
                foreach ($contacts as $contact) {
                    fputcsv($handle, [
                        $contact->last_name . ' ' . $contact->first_name,
                        $contact->gender_name,
                        $contact->email,
                        $contact->tel,
                        $contact->address,
                        $contact->building ?? '-',
                        $contact->category_name,
                        $contact->detail,
                        $contact->created_at->format('Y-m-d'),
                    ]);
                }
            });

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');
        return $response;
    }

    public function destroy($id)
    {
        $contact = Contacts::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin')->with('success', 'お問い合わせを削除しました。');
    }
}
