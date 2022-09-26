@extends('layout/admin-layout')

@section('space-work')
    

<h2 class="mb-4">Exams</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModel">
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
        <th>Attempt</th>
        <th>Add Questions</th>
        <th>Show Questions</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @if (count($exams) > 0)
      @foreach ($exams as $exam)
          <tr>
            <td>{{ $exam->id }}</td>
            <td>{{ $exam->exam_name }}</td>
            {{-- @foreach ($subjects as $subject)
            @if ($exam->subject_id == $subject->id)
            <td>{{ $subject->subject }}</td>  
            @endif
            @endforeach --}}
            <td>{{ $exam->subjects[0]['subject'] }}</td>
            <td>{{ $exam->date }}</td>
            <td>{{ $exam->time }}</td>
            <td>{{ $exam->attempt }} Time</td>
            <td>
              <a href="#" class="addQuestion" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#addQnaModel">Add Question</a>
            </td>
            <td>
              <a href="#" class="seeQuestions" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#seeQnaModel">See Questions</a>
            </td>
            <td>
              <button class="btn btn-info editButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#editExamModel">Edit</button>
            </td>
            <td>
              <button class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#deleteExamModel">Delete</button>
            </td>
          </tr>
      
      @endforeach
      @else
      <tr>
        <td colspan="5">Exams not Found!</td>
      </tr>
      @endif
    </tbody>
  </table>


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
          <br><br>
          <input type="number" min="1" name="attempt" placeholder="Enter Exam Attempt Time" class="w-100" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Exam</button>
          </div>
      </form>

        </div>
    </div>
  </div>




  <!-- Edit Modal -->
  <div class="modal fade" id="editExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
      <form id="editExam">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="exam_id" id="exam_id">
          <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam Name" class=" w-100" required>
          <br><br>
          <select name="subject_id" id="subject_id" required class="w-100">
            <option value="">Select Subject</option>
            @if (count($subjects) > 0)
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                @endforeach
            @endif
          </select>
          <br><br>

          <input type="date" id="date" name="date" class="w-100" required min="@php echo date('Y-m-d'); @endphp">
          <br><br>
          <input type="time" id="time" name="time" class="w-100" required>
          <br><br>
          <input type="number" min="1" id="attempt" name="attempt" placeholder="Enter Exam Attempt Time" class="w-100" required>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
          </div>
      </form>

        </div>
    </div>
  </div>



  <!-- Delete Modal -->
  <div class="modal fade" id="deleteExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
      <form id="deleteExam">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="exam_id" id="deleteExamId">
          <p>Are You Sure ?</p>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
          </div>
      </form>

        </div>
    </div>
  </div>



<!-- Add Qna Modal -->
<div class="modal fade" id="addQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
    <form id="addQna">
      @csrf
      <div class="modal-body">
        <input type="hidden" name="exam_id" id="addExamId">
        <input type="search" name="search" id="search" onkeyup="searchTable()" class="w-100" placeholder="Search Here">
        <br><br>

        <table class="table" id="questionsTable">
          <thead>
            <th>Select</th>
            <th>Question</th>
          </thead>
          <tbody class="addBody">

          </tbody>
        </table>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Q&A</button>
        </div>
    </form>

      </div>
  </div>
</div> 


<!-- See Qna Modal -->
<div class="modal fade" id="seeQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Questions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <th>S.No</th>
            <th>Question</th>
          </thead>
          <tbody class="seeQuestionTable">
          </tbody>
        </table>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
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

        $(".editButton").click(function(){
          var id = $(this).attr('data-id');
          $("#exam_id").val(id);

          var url = '{{ route("getExamDetail", "id") }}';
        url = url.replace('id', id);
        $.ajax({
          url:url,
          type:"GET",
          success:function(data){
            if (data.success == true) {
                var exam = data.data;
                $("#exam_name").val(exam[0].exam_name);
                $("#subject_id").val(exam[0].subject_id);
                $("#date").val(exam[0].date);
                $("#time").val(exam[0].time);
                $("#attempt").val(exam[0].attempt);
            }
            else
            {
              alert(data.msg);
            }
          }
        });
        
        });



        $('#editExam').submit(function(e){
            e.preventDefault();
            
            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('updateExam') }}",
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

        // delete exam

        $(".deleteButton").click(function(){
          var id = $(this).attr('data-id');
          $("#deleteExamId").val(id);
        });

        $('#deleteExam').submit(function(e){
            e.preventDefault();
            
            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('deleteExam') }}",
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

        // add questions part
        $('.addQuestion').click(function(){

         var id = $(this).attr('data-id');

         $('#addExamId').val(id);

         $.ajax({
          url:"{{ route('getQuestions') }}",
          type:"GET",
          data:{exam_id:id},
          success:function(data){
           if (data.success == true) {
            
            var questions = data.data;
              var html = '';
               if (questions.length > 0) {
                for (let i = 0; i < questions.length; i++) {
                  html += `
                  <tr>
                      <td><input type="checkbox" value="`+ questions[i]['id'] +`" name="questions_ids[]"></td>
                      <td>`+ questions[i]['questions'] +`</td>
                  </tr>
                  `;
                }
               }
               else{
                html += `
                <tr>
                  <td colspan="2">Question Not Available!</td>
                  </tr>
                `;
               }

               $(".addBody").html(html);

           }
           else
           {
              alert(data.msg);
           }
          }
         });

        });


        $('#addQna').submit(function(e){
            e.preventDefault();
            
            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('addQuestions') }}",
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


        //see questions
        $('.seeQuestions').click(function(){
          var id = $(this).attr('data-id');

          $.ajax({
            url:"{{ route('getExamQuestions') }}",
            type:"GET",
            data:{exam_id:id},
            success:function(data){
              // console.log(data);

              var html = '';
              var questions = data.data;
              if (questions.length > 0) {
                
                for (let i = 0; i < questions.length; i++) {
                 
                  html += `
                    <tr>
                      <td>`+ (i + 1) +`</td>
                      <td>`+ questions[i]['question'][0]['question']+`</td>
                    </tr>
                  `;
                  
                }

              }
              else
              {
                html +=`
                    <tr>
                      <td colspan="1">Question Not Available!</td>
                    </tr>
                `
              }

              $('.seeQuestionTable').html(html);

            }
          });

        });

        
    });
  </script>



<script>
  function searchTable()
  {
    var input, filter, table, tr, td, i,txtValue;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    table = document.getElementById('questionsTable');
    tr = table.getElementsByTagName("tr");
    for(i = 0; i < tr.length; i++ ){
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        }
        else {
          tr[i].style.display = "none";
        }
      }
    }
  }

</script>


@endsection