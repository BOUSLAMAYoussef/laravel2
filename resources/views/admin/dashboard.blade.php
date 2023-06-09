@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Subjects</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">
    Add Subject
</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Subject</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @if(count($subjects) > 0)
        @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->id }}</td>
            <td>{{ $subject->subject }}</td>
            <td>
                <button class="btn btn-info editButton" data-id="{{ $subject->id }}" data-subject="{{ $subject->subject }}" data-toggle="modal" data-target="#editSubjectModal">Edit</button>
            </td>
            <td>
                <button class="btn btn-danger deleteButton" data-id="{{ $subject->id }}"  data-toggle="modal" data-target="#deleteSubjectModal">Delete</button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4">Subjects not found</td>
        </tr>
        @endif
    </tbody>
</table>
<!-- Modal for adding subject -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="addSubjectForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Subject</label>
                    <input type="text" name="subject" placeholder="Enter Subject Name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal for editing subject -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <form id="editSubjectForm">
                <div class="modal-body">
                    @csrf
                    <label>Subject</label>
                    <input type="text" name="subject" placeholder="Enter Subject Name" id="edit_subject" required>
                    <input type="hidden" name="id" id="edit_subject_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
        
    </div>
</div> 
<!-- Modal for deleting subject -->
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <form id="deleteSubjectForm">
                <div class="modal-body">
                    @csrf
                    <p>Are you sure you want to delete this subject?</p>
                    <input type="hidden" name="id" id="delete_subject_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
              </form>
            </div>
        
    </div>
</div>
<script>
   $(document).ready(function() {
    $("#addSubjectForm").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var url = "{{ route('addSubject') }}";
        var token = "{{ csrf_token() }}";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-Token": token
            },
            success: function(data) {
                if (data.success == true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        });
    });

    // Edit subject
    $(".editButton").click(function() {
        var subjectId = $(this).attr('data-id');
        var subject = $(this).attr('data-subject');
        $("#edit_subject").val(subject);
        $("#edit_subject_id").val(subjectId);
    });

    $("#editSubjectForm").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var url = "{{ route('editSubject') }}";
        var token = "{{ csrf_token() }}";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-Token": token
            },
            success: function(data) {
                if (data.success == true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        });
    });
    $(".deleteButton").click(function(){
        var subject_id =$(this).attr('data-id');
        $("#delete_subject_id").val(subject_id);

    });
    $("#deleteSubjectForm").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var url = "{{ route('deleteSubject') }}";
        var token = "{{ csrf_token() }}";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-Token": token
            },
            success: function(data) {
                if (data.success == true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        });
    });
});

</script>
@endsection
