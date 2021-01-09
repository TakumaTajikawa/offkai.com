@csrf
<div class="md-form">
  <label>タイトル <span style="font-size: 12px;">※必須</span></label>
  <input type="text" name="title" class="form-control" required value="{{ $plan->title ?? old('title') }}" style="margin-top: 40px;">
</div>

<div class="form-group">
  <plan-tags-input
    :initial-tags='@json($tagNames ?? [])'
  >
  </plan-tags-input>
</div>

<div class="form-group">
  <label>開催日時 <span style="font-size: 12px;">※必須</span></label>
  <input type="datetime-local" name="meeting_date_time" class="form-control" required value="{{ empty($plan->meeting_date_time) ? null : $plan->meeting_date_time->format('Y-m-d\TH:i') }}" min="2021-01-05T00:00" max="2022-01-01T00:00">
</div>

<div class="form-group">
  <label>場所（都道府県） <span style="font-size: 12px;">※必須</span></label>
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
  <label>場所（区市町村）</label>
  <input type="text" name="cities" class="form-control" value="{{ $plan->cities ?? old('cities') }}">
</div>

<div class="md-form">
  <label>会場</label>
  <input type="text" name="venue" class="form-control" value="{{ $plan->venue ?? old('venue') }}">
</div>

<div class="md-form">
  <label>会費</label>
  <input type="text" name="membership_fee" class="form-control" value="{{ $plan->membership_fee ?? old('membership_fee') }}">
</div>

<div class="md-form">
  <label>募集年齢</label>
  <input type="text" name="age" class="form-control" value="{{ $plan->age ?? old('age') }}">
</div>

<!-- <div class="md-form">
  <label>ジャンル</label>
  <input type="text" name="genre" class="form-control" value="{{ $plan->genre ?? old('genre') }}">
</div> -->

<div class="form-group">
  <label>説明 <span style="font-size: 12px;">※必須</span></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="【例】：初めまして！私は〇〇県□□市在住の△△と申します。今回は〇〇県□□市で◇◇好きな方同士で集まり情報交換も兼ねてオフ会を開催したいと思います。お酒を飲みながらゆるーく語りましょう！！">{{ $plan->body ?? old('body') }}</textarea>
</div>