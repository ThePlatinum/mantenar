<!-- Modal -->
<div class="modal fade" id="editAccessModal" tabindex="-1" aria-labelledby="EditAccess" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editAccessModalLabel">Edit File Viewer's</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4">
        <form action="{{route('give_access')}}" method="POST">
          @csrf
          <input type="hidden" name="share_id" value="{{$share->id}}">
          <label for="viewers" class="col-form-label py-2">Add New Viewers <small>(who to share the file with)</small></label>
          <select multiple name="viewers[]" id="viewers" class="form-control">
            @forelse ($users as $user)
            <option value="{{$user->id}}">{{$user->fullname}} ({{$user->is_admin ? 'Admin' : 'Staff' }} | {{$user->job_title}})</option>
            @empty
            @endforelse
          </select>
          @error('viewers')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
          <button class="btn btn__b_blue px-5 mt-2 mb-3 ">Add Viewers</button>
        </form>

        <div class="py-4">
          <div class="table-responsive">
            <table data-toggle="table" data-search="true" data-sortable="true" class="table align-middle table-striped text-nowrap">
              <thead>
                <tr class="bg-light">
                  <th scope="col">SN</th>
                  <th scope="col" data-sortable="true">User</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($share->viewers as $viewer)
                <tr>
                  <td> {{$loop->index + 1}} </td>
                  <td> {{$viewer->fullname}} | {{$user->job_title}} </td>
                  <td class="float__left">
                    <btn class="btn btn-outline-danger" onclick="remove_access('{{$viewer->id}}')">Remove</btn>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>