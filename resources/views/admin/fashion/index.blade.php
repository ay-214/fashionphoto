@extends('layouts.admin')
@section('title', '投稿されたスタイリングフォトの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>スタイリングフォト一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.fashion.add') }}" role="button" class="btn btn-primary">新規投稿</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.fashion.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル：スタイリングポイント</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-fashion col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル：スタイリングポイント</th>
                                <th width="50%">本文：身長とか</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $fashion)
                                <tr>
                                    <th>{{ $fashion->id }}</th>
                                    <td>{{ Str::limit($fashion->title, 100) }}</td>
                                    <td>{{ Str::limit($fashion->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.fashion.edit', ['id' => $fashion->id]) }}">編集</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection