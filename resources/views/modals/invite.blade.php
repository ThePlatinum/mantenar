<!-- Modal -->
<div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="Invite" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="inviteModalLabel">New Invite</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('send_invite')}}" method="POST">
          @csrf
          <label for="invite_email" class="col-form-label py-2 pt-4">Email Address</label>
          <p><small>(seperate with comman for multiple invites)</small></p>
          <input id="invite_email" placeholder="eg. useremail1@domain.com, useremail2@domain.com" class="form-control" name="invite_email" autofocus value="{{old('invite_email')}}" required/>
          @error('invite_email')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror

          <div class="text-center">
            <button class="btn btn__b_blue px-5 mt-4 mb-3 btn-lg">Send Invites</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>