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
            </tr>
        </thead>
        <tbody>
            @if(count($exams)>0)
                @foreach($exams as $exam)
                     <tr>
                            <td>{{$exam->id}}</td>
                            <td>{{$exam->exam_name}}</td>
                            <td>{{$exam->subject->subject}}</td>

                            <td>{{$exam->date}}</td>
                            <td>{{$exam->time}}</td>
                     </tr>
                @endforeach

            @else 
                <tr>
                    <td colspan="5">Exams not found</td>
                </tr>
            
            
            
            @endif


            
        </tbody>
        
    </table>

    <!-- Modal for adding subject -->
    <div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addExamForm">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="exam_name" placeholder="Enter Exam Name" class="w-100" required>
                        <br><br>
                        <select name="subject_id" required class="w-100">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject}}</option>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#addExamForm").submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{route('addExam')}}",
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
