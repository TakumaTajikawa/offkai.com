<div class="card">
  <div class="p-3">
    <div class="p-2 mb-3 mx-4 text-center" style="background-color: rgb(254,87,33); color: #fff; border-radius: 5px;">
      <p class="mb-0" style="font-size: 14px;">聞きたいこと・伝えたいことなどをコメントしてみましょう</p>
    </div>
    <form method="POST" action="{{ route('comments.store') }}">
      @csrf
      <div class="form-group mb-0">
        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="4" placeholder="コメントする...">
          @error('text')
            {{ old('text') }}
          @enderror
        </textarea>
        @error('text')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-0">
        <div class="text-right">
          <p class="mb-4 text-danger" style="font-size: 12px;">200文字以内</p>
          <button type="submit" class="btn submit-btn">
            コメントする
          </button>
        </div>
      </div>
    </form>
  </div>
</div>