@extends('layouts.front')
@section('content')
    <div class="container">
        <hr color="#C0C0C0">
        @if (!is_null($headline))
        <h1>New! -新着スタイリングスナップ-</h1>
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="image">
                                    @if ($headline->image_path)
                                        <img src="{{ asset('storage/image/' . $headline->image_path) }}">
                                    @endif
                                </div>
                                <div class="title p-2">
                                    <h1>{{ Str::limit($headline->title, 70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="body mx-auto">{{ Str::limit($headline->body, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            検索結果はありませんでした。
        @endif
        <hr color="#C0C0C0">
        <div class="row">
                {{-- 投稿を3つ横並びに表示する設定 --}}
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="date">
                            {{ $post->updated_at->format('Y年m月d日') }}
                        </div>
                        <div class="title">
                            {{ Str::limit($post->title, 150) }}
                        </div>
                        <div class="body mt-3">
                            {{ Str::limit($post->body, 1500) }}
                        </div>

                        <div class="image text-right mt-4">
                            @if ($post->image_path)
                            <img src="{{ asset('storage/image/' . $post->image_path) }}">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection