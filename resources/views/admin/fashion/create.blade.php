{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'スタイリングフォトの投稿'を埋め込む --}}
@section('title', 'スタイリングフォトの投稿')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>スタイリングフォト投稿</h2>
            </div>
        </div>
    </div>
@endsection












