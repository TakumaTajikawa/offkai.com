@csrf
<div class="md-form">
  <label>プラン名 <span style="font-size: 7px; color: #fff; background-color: #FF367F; border-radius: 5px; padding: 2px; position: relative; bottom: 2px;">※必須</span></label>
  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ $plan->title ?? old('title') }}" style="margin-top: 40px;">
  @error('title')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="md-form">
  <label>会場</label>
  <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" value="{{ $plan->venue ?? old('venue') }}">
  @error('venue')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-group">
  <label>開催日時 <span style="font-size: 7px; color: #fff; background-color: #FF367F; border-radius: 5px; padding: 2px; position: relative; bottom: 2px;">※必須</span></label>
  <input type="datetime-local" name="meeting_date_time" class="form-control" required value="{{ empty($plan->meeting_date_time) ? null : $plan->meeting_date_time->format('Y-m-d\TH:i') }}" min="2021-01-05T00:00" max="2022-01-01T00:00">
</div>

<div class="form-group">
  <label>都道府県 <span style="font-size: 7px; color: #fff; background-color: #FF367F; border-radius: 5px; padding: 2px; position: relative; bottom: 2px;">※必須</span></label>
  <select type="text" class="form-control" name="prefecture" required value="{{ $plan->prefecture ?? old('prefecture') }}">
    <option disabled selected style="display: none;">選択してください</option>
    @foreach(config('pref') as $key => $value)
      <option value="{{ $value }}" @if ($plan->prefecture == $value) selected @endif>
        {{ $value }}
      </option>
    @endforeach
  </select>
</div>

<div class="md-form">
  <label>会場住所<span style="font-size: 13px;">（都道府県以下）</span></label>
  <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $plan->address ?? old('address') }}">
  @error('address')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="md-form">
  <label>会費</label>
  <input type="text" name="membership_fee" class="form-control @error('membership_fee') is-invalid @enderror" value="{{ $plan->membership_fee ?? old('membership_fee') }}">
  @error('membership_fee')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="md-form">
  <label>定員 <span style="font-size: 11px;">※半角数字を入力</span></label>
  <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ $plan->capacity ?? old('capacity') }}">
  @error('capacity')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="md-form">
  <label>募集年齢</label>
  <input type="text" name="age" class="form-control @error('age') is-invalid @enderror" value="{{ $plan->age ?? old('age') }}">
  @error('age')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-group">
  <label>タグ</label>
  <plan-tags-input
    :initial-tags='@json($tagNames ?? [])'
    :autocomplete-items='@json($allTagNames ?? [])'
  >
  </plan-tags-input>
</div>

<div class="form-group">
  <label>説明 <span style="font-size: 7px; color: #fff; background-color: #FF367F; border-radius: 5px; padding: 2px; position: relative; bottom: 2px;">※必須</span></label>
  <textarea name="body" required class="form-control @error('body') is-invalid @enderror" rows="16" placeholder="【例】：初めまして！私は〇〇県□□市在住の△△と申します。今回は〇〇県□□市で◇◇好きな方同士で集まり情報交換も兼ねてオフ会を開催したいと思います。お酒を飲みながらゆるーく語りましょう！！">
    {{ $plan->body ?? old('body') }}
    @error('body')
      {{ old('body') }}
    @enderror
  </textarea>
  @error('body')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-group mt-5 d-flex flex-column">
  <label for="img" class="mb-2">
    プロフィール画像
  </label>
  <input type="file" name="img" accept="image/png, image/jpeg, image/jpg" class="@error('img') is-invalid @enderror">
  @error('img')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
<img id="preview" src="{{ $plan->img ? $plan->img : '/storage/noimage.png' }}" alt="プロフィール画像" style="width: 120px; height: 120px;" class="mb-4">