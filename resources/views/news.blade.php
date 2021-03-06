@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-5 align-self-center">
            <h3 class="page-title">News</h3>
        </div>
        <div class="col-12">
            @if(!count($news))
                <div class="card">
                    <div class="card-header">News Info</div>
                    <div class="card-body">
                        <h4 class="card-title">There is no News ATM</h4>
                        <p class="card-text">Every News will be shown here.</p>
                    </div>
                </div>
            @endif
            @foreach($news as $item)
                <div class="card">
                    <div class="card-header">{{$item['title']}}</div>
                    <div class="card-body">
                        <p class="card-text">{{$item['category']}}</p>
                        <h4 class="card-title">{!! $item['content'] !!}</h4>
                        <span class="font-10">{{$item->created_at->diffForHumans()}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection