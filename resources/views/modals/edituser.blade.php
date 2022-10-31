<!-- Modal -->
<div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="EditUser" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="inviteModalLabel">Edit User Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{route('edit_user')}}" method="POST">
          @csrf
          <input type="hidden" name="user_id" value="{{$user->id}}">

          <input class="form-control setup_input @error('firstname') is-invalid @enderror" autocomplete name="firstname" placeholder="First Name" required value="{{old('firstname') ?? $user->firstname}}">
          @error('firstname')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

          <input class="form-control setup_input @error('lastname') is-invalid @enderror" autocomplete name="lastname" placeholder="Last Name" required value="{{old('lastname') ?? $user->lastname}}">
          @error('lastname')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

          <input class="form-control setup_input @error('job_title') is-invalid @enderror" autocomplete name="job_title" placeholder="Job Title" required value="{{old('job_title') ?? $user->job_title}}">
          @error('job_title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

          <select name="role" id="role" class="form-control setup_input @error('role') is-invalid @enderror" required>
            <option value="admin" @if($user->is_admin) selected @endif>Admin</option>
            <option value="staff" @if(!$user->is_admin) selected @endif>Staff</option>
          </select>
          @error('role')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

          <input type="submit" value="Save Changed" class="btn btn__b_blue px-4 btn-lg mt-3">
        </form>
      </div>
    </div>
  </div>
</div>