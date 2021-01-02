@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ old('title') }}" style="margin-top: 40px;">
  <label style="margin-top: 60px;">開催日時</label>
  <input type="datetime-local" name="meeting_date_time" class="form-control" required value="{{ old('meeting_date_time') }}" format="('Y年m月d日 H時i分')" style="margin-top: 50px;">
  <label style="margin-top: 150px;">場所（都道府県）</label>
  <select type="text" class="form-control" name="pref_id" style="margin-top: 55px;" required value="{{ old('pref_id') }}">                          
    @foreach(config('pref') as $key => $score)
      <option value="{{ $score }}">{{ $score }} </option>
    @endforeach
  </select>
  <label style="margin-top: 230px;">場所（区市町村）</label>
  <input type="text" name="cities" class="form-control" required value="{{ old('cities') }}" style="margin-top: 40px;">
  <label style="margin-top: 310px;">募集年齢</label>
  <input type="text" name="cities" class="form-control" required value="{{ old('cities') }}" style="margin-top: 40px;">
  <label style="margin-top: 390px;">ジャンル</label>
  <input type="text" name="cities" class="form-control" required value="{{ old('cities') }}" style="margin-top: 40px;">

  
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ old('body') }}</textarea>
</div>

<div class="card form-group" style="width: 20rem;margin:10px;">
  <div class="card-body">
    <h4 class="card-title">画像を選んでください。</h4>
    <input type="file" accept="image/*">
  </div>
</div>
