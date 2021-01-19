<div class="card mb-4 smallcard">
  <div class="card-body d-flex flex-row">
    <a href="{{ route('users.show', ['name' => optional($plan->user)->name]) }}" class="text-dark">
      <i class="fas fa-user-circle fa-3x mr-1"></i>
    </a>
    <div class="ml-2">
      <div class="font-weight-bold">
        <a href="{{ route('users.show', ['name' => optional($plan->user)->name]) }}" class="text-dark">
          {{ optional($plan->user)->name }}
        </a>
      </div> 
      <div class="font-weight-lighter">
        {{ $plan->created_at->format('Y-m-d H:i') }}
      </div>
    </div>
    @if( Auth::id() === $plan->user_id )
      <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <button type="button" class="btn btn-link text-muted m-0 p-2">
              <i class="fas fa-ellipsis-v"></i>
            </button>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('plans.edit', ['plan' => $plan]) }}">
              <i class="fas fa-pen mr-1"></i>プランを編集する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $plan->id }}">
              <i class="fas fa-trash-alt mr-1"></i>プランを削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-{{ $plan->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('plans.destroy', ['plan' => $plan]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $plan->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
    @endif
  </div>
  <div class="card-body pt-0 pb-2">
    <h4 class="card-title">
      <a class="plan-title" href="{{ route('plans.show', ['plan' => $plan]) }}">
        {{ $plan->title }}
      </a>
    </h4>
    <div class="table-responsive">
      <table class="table table-bordered" width="100%">
        <tbody>
          <tr>
            <th scorp="row" class="font-weight-bold p-2" width="25%" style="font-size: 14px;">
              開催日時
            </th>
            <td  class="p-2" width="75%">
              {{ $plan->meeting_date_time->format('Y年n月j日G:i') }}〜
            </td>
          </tr>
          <tr>
            <th scorp="row" class="font-weight-bold p-2" width="25%">
              都道府県
            </th>
            <td  width="75%" class="p-2">
              {{ $plan->prefecture }}
            </td>
          </tr>
          <tr>
            <th scorp="row" height="auto" class="font-weight-bold p-2" width="25%">
              タグ
            </th>
            <td  width="75%" height="auto" class="p-2">
              @foreach($plan->tags as $tag)
                @if($loop->first)
                  <div class="card-body p-0">
                    <div class="card-text line-height">
                @endif
                      <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="tag">
                        {{ $tag->name }}
                      </a>
                @if($loop->last)
                    </div>
                  </div>
                @endif
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <h6 class="my-4">
    </h6>
    <div class="card-text d-flex part-body">
      <span>
        {{ Str::limit($plan->body, 80, '...') }}
        <a href="{{ route('plans.show', ['plan' => $plan]) }}" style="color: rgb(116,115,115);" class="read_more">
          続きを見る
        </a>
      </span>
    </div>
  </div>
</div>