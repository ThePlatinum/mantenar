<!-- Modal -->
<div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="Invite" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="inviteModalLabel">New Invite</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{route('send_invite')}}" method="POST">
          @csrf
          <label for="invite_email" class="col-form-label py-2">Email Address <small>(seperate with comman for multiple invites)</small></label>
          <input id="invite_email" placeholder="eg. useremail1@domain.com, useremail2@domain.com" class="form-control @if(session()->has('invite_error'))is-invalid @endif" name="invite_email" autofocus value="{{old('invite_email')}}" required />
          @if(session()->has('invite_error'))
          <span class="text-danger" role="alert">
            <strong>{{session()->get('invite_error')}}</strong>
          </span>
          @endif

          <div class="text-center">
            <button class="btn btn__b_blue px-5 mt-4 mb-3">Send Invites</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>