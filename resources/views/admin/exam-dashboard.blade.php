@extends('layout/admin-layout')

@section('space-work')
    

<h2 class="mb-4">Exams</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModel">
    Add Exam
  </button>

<!-- Modal -->
  <div class="modal fade" id="addExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
      <form id="addExam">
        @csrf
        <div class="modal-body">
          <input type="text" name="exam_name" placeholder="Enter Exam Name" class=" w-100" required>
          <br><br>
          <select name="subject_id" required class="w-100">
            <option value="">Select Subject</option>
            @if (count($subjects) > 0)
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                @endforeach
            @endif
          </select>
          <br><br>

          <input type="date" name="date" class="w-100" required min="@php echo date('Y-m-d'); @endphp">
          <br><br>
          <input type="time" name="time" class="w-100" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Exam</button>
          </div>
      </form>

        </div>
    </div>
  </div>


  <script>
    $(document).ready(function(){
        $('#addExam').submit(function(e){
            e.preventDefault();
            
            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('addExam') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if (data.success == true) {
                        location.reload();
                    }
                    else
                    {
                        alert(data.msg);
                    }
                }
            });
        });
    });
  </script>

@endsection