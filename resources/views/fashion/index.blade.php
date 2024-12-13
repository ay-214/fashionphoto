@extends('layouts.front')
@section('content')
    <div class="container">
        <hr color="#C0C0C0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="newpost">New! -新着スタイリングスナップ-</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="image">
                                    @if ($headline->image_path)
                                        <img src="{{ asset('storage/image/' . $headline->image_path) }}">
                                    @endif
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="body mx-auto">{{ Str::limit($headline->body, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr color="#C0C0C0">
        @endif
        <div class="row">
            @if ($posts->isNotEmpty())
                {{-- 投稿を3つ横並びに表示する設定 --}}
                @foreach ($posts as $post)
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
            @else
                検索結果はありませんでした。
            @endif

        </div>
    </div>
@endsection
