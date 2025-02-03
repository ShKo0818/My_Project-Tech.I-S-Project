@extends('adminlte::page')

@section('title', '発注')

@section('content_header')
    <h1>発注</h1>
@stop

@section('content')
    @if(Auth::check() && (Auth::user()->user_type === 'corporate' || Auth::user()->user_type === 'master'))
        <div class="row">
            <div class="col-md-10">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-primary">
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="item_id">商品を選択</label>
                                <select name="item_id" id="item_id" class="form-control">
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->category }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="quantity">数量</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="数量を入力" required>
                            </div>

                            <div class="form-group">
                                <label for="delivery_date">希望納期</label>
                                <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                            </div>

                            <div class="form-group">
                                <label for="remarks">備考</label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="特記事項があれば入力"></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                        <a href="{{ route('order.create') }}" class="btn btn-primary">発注画面に進む</a>

                        </div>
                        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger">このページへアクセスする権限がありません。</div>
        <a href="{{ route('home') }}" class="btn btn-secondary">ホームへ戻る</a>
    @endif
@stop
