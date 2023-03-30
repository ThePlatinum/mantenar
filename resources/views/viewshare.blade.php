@extends('layouts.app')
@section('app_content')
@php
$messages = array();
@endphp
<div class="row py-4">
  <div class="col-md-8 pb-4 pb-md-0">
    <div class="r__10 p-3 bg-white">
      <div class="row">
        <div class="col-md-9 pb-3 pb-md-0">
          <h2> {{$share->name}} </h2>
          <h5>Shared by <b>{{$share->owner->fullname}}</b> {{ $share->viewers->count() > 0 ? 'with '. $share->viewers[0]->fullname : '' }}
            @if ($share->viewers->count() > 1)
            <span class="__others">+{{$share->viewers->count()-1}} others</span>
            @endif
          </h5>
          <p class="m-0 p-0">{{$share->storage['size']}}{{$share->storage['type']}} | {{ date_format($share->created_at, 'd, M Y') }} </p>
        </div>
        <div class="col-md-3">
          <div class="d-flex gap-2 flex-md-column ">
            <a href="{{$share->file_url}}" download="{{\Str::slug($share->name, '_')}}" class="btn btn__b_outline_blue btn-sm">Download</a>
            @if ($share->owner == auth()->user() || auth()->user()->is_admin)
            <button class="btn btn__b_outline_blue btn-sm" data-bs-toggle="modal" data-bs-target="#editAccessModal">
              Edit Viewers
            </button>
            @include('modals.fileaccess')
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="r__10 filbox my-3 p-3">
      @switch(strtolower($share->type))
      @case('png')
      @case('jpeg')
      @case('jpg')
      <img src="{{$share->file_url}}" alt="{{$share->name}}" class="file__share" />
      @break
      @case('pdf')
      <iframe src="{{$share->file_url}}" class="file__share">Your browser isn't compatible with this file type download the file and open locally on your device</iframe>
      @break
      @case('mp4')
      @case('mkv')
      <video src="{{$share->file_url}}" class="file__share" controls>Your browser isn't compatible with this file type download the file and open locally on your device</video>
      @break
      @default
      <div class="file__share p-5 text-center"> Can't display file type </div>
      @endswitch
    </div>
  </div>
  <div class="col-md-4">
    <div class="r__10 p-3 bg-white mb-4">
      <small>Shared Note</small>
      <hr class="mt-0 pt-0">
      <p> {{$share->note}} </p>
    </div>

    <div class="r__10 p-3 bg-white">
      <small>Comments</small>
      <hr class="mt-0 pt-0">

      <div id="comments_list" class="__comments">
        @forelse($comments as $comment)
        @php array_push($messages, $comment->id); @endphp
        <div class="{{ ($comment->user_id == Auth()->user()->id) ? 'comment__right' : 'comment__left'}}">
          <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 bg-me">
            {{$comment->body}}
            <div class="text-muted small text-nowrap">
              <small> @if ($comment->user_id != Auth()->user()->id) {{$comment->sender_name}} <br> @endif {{$comment->date.' | '.$comment->time }}</small>
            </div>
          </div>
        </div>
        @empty
        <div class="p-5 text-center">
          No comments on this file shared yet
        </div>
        @endforelse
      </div>

      <div class="py-3 border-top">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Type your comment" id="comment_box">
          <button class="btn btn__b_blue d-flex justify-content-center align-items-center gap-2" onclick="send_comment()">Send <i class='bx bx-send'></i></button>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function scroll_comments_list() {
    try {
      $('#comments_list').animate({
        scrollTop: $('#comments_list').prop("scrollHeight")
      }, 200);
    } catch (error) {
      let comments_list = document.getElementById('comments_list')
      comments_list.scrollTop = comments_list.scrollHeight + 10
    }
  }
  scroll_comments_list()
  let msg_list = <?php echo json_encode($messages); ?>;
  let length = <?php echo $comments->count(); ?>;

  function send_comment() {
    $.ajax({
      url: "{{route('send_comment')}}",
      method: 'POST',
      data: {
        share_id: "<?php echo $share->id ?>",
        body: $('#comment_box').val(),
        _token: '{{csrf_token()}}'
      },
      error: err => {},
      success: result => {
        if (result.comment) {
          if (length < 1) $('#comments_list').text('')
          $('#comments_list').append(`
          <div class=${ (result.comment.user_id == <?php echo Auth()->user()->id; ?> ) ? 'comment__right' : 'comment__left'}>
            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 bg-me">
              ${result.comment.body}
              <div class="text-muted text-nowrap">  <small>${result.comment.date + ' | ' +result.comment.time}</small> </div>
            </div>
          </div>`)
          $('#comment_box').val('')
          scroll_comments_list()
          msg_list.push(result.comment.id)
        }
      }
    })
  }

  try {
    const viewrs = $('#viewers').filterMultiSelect({
      placeholderText: "Select Viewers",
      filterText: "Search",
      selectAllText: "Select All",
      labelText: "",
      caseSensitive: false,
    })
  } catch (error) {}

  function remove_access(user_id) {
    bootbox.confirm({
      title: "Remove Viewer?",
      message: "This user will no longer have access to this file share. <br/> <br/> Proceed?",
      callback: e => {
        if (e)
          $.ajax({
            url: "{{route('remove_access')}}",
            method: 'POST',
            data: {
              user_id: user_id,
              share_id: '{{$share->id}}',
              _token: '{{csrf_token()}}'
            },
            success: () => {
              window.location.href = "{{$share->slug}}"
            }
          })
      }
    });
  }

  function newComment(data) {
    if (!msg_list.includes(data.xpr)) {

      $.ajax({
        url: "/get_comment" + '/' + data.xpr,
        method: 'GET',
        error: err => {},
        success: result => {
          if (result.comment) {
            if (length < 1) $('#comments_list').text('')
            $('#comments_list').append(`
            <div class=${ (result.comment.user_id == <?php echo Auth()->user()->id; ?> ) ? 'comment__right' : 'comment__left'}>
              <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 bg-me">
                ${result.comment.body}
                <div class="text-muted text-nowrap">  <small>${result.comment.date + ' | ' +result.comment.time}</small> </div>
              </div>
            </div>`)
            scroll_comments_list()
            msg_list.push(result.comment.id)

            const notification = new Notification('New Comment ', {
              body: result.comment.body,
              tag: 'mantenarComment',
              icon: '/images/mantenar.svg',
              badge: '/images/mantenar.svg',
              vibrate: [200, 100, 200]
            });
          }
        }
      })
    }
  }

  const comment_channel = pusher.subscribe("private-comments.{{$share->id}}");
  comment_channel.bind("App\\Events\\NewComment", (data) => {
    newComment(data);
  });
</script>
@endpush

@endsection