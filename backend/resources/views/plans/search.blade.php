@extends('app')

@section('title', '検索')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-9">
        <div class="card mt-3 mb-4">
          <div class="card-header text-center">
            <span style="color: rgb(124,123,123); font-size: 18px;">
              オフ会検索
            </span>
          </div>
          <div class="card-body pt-0">
            <div class="card-text pt-3">
              <form method="GET" action="{{ route('plans.search') }}">
                <div class="form-group">
                  <label class="font-weight-bold mb-0" style="font-size: 15px;">プラン名</label>
                  <input type="text" name="title" class="form-control" placeholder="指定なし" value="@if (isset($search1)) {{ $search1 }} @endif">
                </div>

                <div class="form-group mt-4">
                  <label class="font-weight-bold mb-0" style="font-size: 15px;">都道府県</label>
                  <select type="text" class="form-control" name="prefecture" value="{{ old('prefecture') }}">
                    <option disabled selected style="display: none;">指定なし</option>
                    @foreach(config('pref') as $key => $value)
                      <option value="{{ $value }}" @if ($search2 == $value) selected @endif>
                        {{ $value }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-block" style="margin-top: 40px; background-color: rgb(	0,200,179); color: #fff;">
                  検索
                </button>
              </form>
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
