<li class="list-group-item card">
  <div class="py-3">
    <div class="p-2 mb-3 text-center" style="background-color: rgb(254,87,33); color: #fff; border-radius: 5px;">
      <p class="mb-0" style="font-size: 14px;">聞きたいこと・伝えたいことなどをコメントしてみましょう</p>
    </div>
    <form method="POST" action="{{ route('comments.store') }}">
      @csrf
        <div class="form-group row mb-0">
          <div class="col-md-12 p-3 w-100 d-flex">
            <a href="{{ route('users.show', ['name' => Auth::user()->name]) }}" class="in-link text-dark">
              <i class="fas fa-user-circle fa-3x"></i>
            </a>
            <div class="ml-2 d-flex flex-column font-weight-bold">
                <a href="{{ route('users.show', ['name' => Auth::user()->name]) }}" class="in-link text-dark">
                  <p class="mb-0">{{ Auth::user()->name }}</p>
                </a>
            </div>
          </div>
          <div class="col-md-12">
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
        </div>

        <div class="form-group row mb-0">
          <div class="col-md-12 text-right">
            <p class="mb-4 text-danger" style="font-size: 12px;">200文字以内</p>
            <button type="submit" class="btn" style="background-color: rgb(	0,200,179); color: #fff;">
              コメントする
            </button>
          </div>
        </div>
      </form>
  </div>
</li>