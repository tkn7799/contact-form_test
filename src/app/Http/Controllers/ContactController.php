<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contacts;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
    $validated = $request->validated();

    $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];

    unset($validated['tel1'], $validated['tel2'], $validated['tel3']);

    $genderMap = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];
    $validated['gender_name'] = $genderMap[$validated['gender']] ?? '未設定';
    
    $categories = \App\Models\Category::pluck('content', 'id')->toArray();
    $validated['category_name'] = $categories[$validated['category_id']] ?? '未選択';

    return view('confirm', ['inputs' => $validated]);
    }

    public function send(Request $request)
    {
    $inputs = $request->all();

    if ($request->input('action') === 'back') {
        // 入力画面に戻る
        return redirect()->route('contacts.form')->withInput($inputs);
    }

    if ($request->input('action') === 'send') {
        // データベースに保存
        Contacts::create([
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'gender' => $inputs['gender'],
            'email' => $inputs['email'],
            'tel' => $inputs['tel'] ,
            'address' => $inputs['address'] ?? null,
            'building' => $inputs['building'],
            'category_id' => $inputs['category_id'],
            'detail' => $inputs['message'],
        ]);
        
        return view('thanks');
    }


    return redirect()->route('contacts.form');
    }
}
