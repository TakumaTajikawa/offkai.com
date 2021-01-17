@extends('app')

@section('title', 'プラン検索')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3 text-center">
          <div class="card-header">
            <span style="color: rgb(124,123,123); font-size: 18px;">
              プラン検索
            </span>
          </div>
          <div class="card-body text-left">
            <div class="card-text">

              {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
                <div class="form-group">
                  {!! Form::label('text', 'プラン名:') !!}
                  {!! Form::text('title' ,'', ['class' => 'form-control', 'placeholder' => '指定なし'] ) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('prefecture', '都道府県:') !!}
                  {!! Form::select('prefecture', ['指定なし' => '指定なし'] + Config::get('prefecture.todoufuken') ,'指定なし') !!}
                </div>
                <div class="form-group">
                  {!! Form::label('text', '住所:') !!}
                  {!! Form::text('address' ,'', ['class' => 'form-control', 'placeholder' => '指定なし'] ) !!}
                </div>
                {!! Form::submit('検索', ['class' => 'btn btn-primary btn-block']) !!}
              {!! Form::close() !!}

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
@endsection
