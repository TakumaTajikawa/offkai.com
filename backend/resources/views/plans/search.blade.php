@extends('app')

@section('title', '検索')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3 mb-4">
          <div class="card-header text-center">
            <span style="color: rgb(124,123,123); font-size: 18px;">
              オフ会検索
            </span>
          </div>
          <div class="card-body pt-0">
            <div class="card-text pt-3">

              {!! Form::open(['route' => 'plans.search', 'method' => 'get']) !!}
                <div class="form-group">
                  {!! Form::label('text', 'プラン名') !!}
                  {!! Form::text('title' ,'', ['class' => 'form-control', 'placeholder' => '指定なし'] ) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('prefecture', '都道府県') !!}
                  {!! Form::select('prefecture', ['指定なし' => '指定なし'] + Config::get('prefecture.todoufuken') ,'指定なし') !!}
                </div>
                {!! Form::submit('検索', ['class' => 'btn btn-primary btn-block']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>

        @forelse($data1 as $plan)
          @include('plans.smallcard')
        @empty
          <div class="card mb-4">
            <div class="card-body text-center py-5" style="color: rgb(108,117,125);">
              条件に一致するオフ会はありません
            </div>
          </div>
        @endforelse

      </div>
    </div>
  </div>
  @include('footer')
@endsection
