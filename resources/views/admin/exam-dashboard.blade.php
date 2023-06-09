@extends('layout.admin-layout')

@section('space-work')
    <h2 class="mb-4">Exams</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModal">
        Add Exam
    </button>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Exam Name</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if(count($exams)>0)
                @foreach($exams as $exam)
                     <tr>
                            <td>{{ $exam->id }}</td>
                            <td>{{ $exam->exam_name }}</td>
                            <td>{{ $exam->subject ? $exam->subject->subject : 'N/A' }}</td>

                            <td>{{ $exam->date }}</td>
                            <td>{{ $exam->time }}</td>
                            <td>
                                <button class="btn btn-info editButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#editExamModal">Edit</button>
                            </td>
                            <td>
                                <button class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#deleteExamModal">Delete</button>
                            </td>
                     </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="6">Exams not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Modal for adding exam -->
    <div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addExam">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="exam_id" id="exam_id">
                        <input type="text" name="exam_name" placeholder="Enter Exam Name" class="w-100" required>
                        <br><br>
                        <select name="subject_id" required class="w-100">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <input type="date" name="date" class="w-100" required min="{{ date('Y-m-d') }}">
                        <br><br>
                        <input type="time" name="time" class="w-100" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for updating exam-->
    <div class="modal fade" id="editExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editExam">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="exam_id" id="exam_id">
                        <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam Name" class="w-100" required>
                        <br><br>
                        <select name="subject_id" id="subject_id" required class="w-100">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <input type="date" name="date" id="date" class="w-100" required min="{{ date('Y-m-d') }}">
                        <br><br>
                        <input type="time" name="time" id="time" class="w-100" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for deleting exam-->
    <div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteExam">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="exam_id" id="deleteExamId">
                        <p>Are you sure you want to Delete this exam?</p>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#addExam").submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('addExam') }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });

            $(".editButton").click(function () {
                var id = $(this).data('id');
                $("#exam_id").val(id);

                var url = '{{ route("getExamDetail", ":id") }}';
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (data) {
                        if (data.success == true) {
                            var exam = data.data;
                            $("#exam_name").val(exam[0].exam_name);
                            $("#subject_id").val(exam[0].subject_id);
                            $("#date").val(exam[0].date);
                            $("#time").val(exam[0].time);
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });

            $("#editExam").submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('updateExam') }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });
            //delete exam
            $(".deleteButton").click(function(){
                var id = $(this).attr('data-id');
                $("#deleteExamId").val(id);

            });
            $("#deleteExam").submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('deleteExam') }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        if (data.success) {
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
