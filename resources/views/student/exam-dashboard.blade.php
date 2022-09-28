@extends('layout/layout-common')

@section('space-work')

    <div class="container">
        <p style="color:black;">Welcome, {{ Auth::user()->name }}</p>
        <h1 class="text-center">{{ $exam[0]['exam_name'] }}</h1>
        @if ($success == true)
            @if (count($qna) > 0)
            <form action="" method="POST" class="mb-5">
                <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">
            @php  $qcount = 1;  @endphp
                @foreach ($qna as $data)
                    <div>
                        <h5>Q{{ $qcount++ }}. {{ $data['question'][0]['question'] }}</h5>
                        <input type="hidden" name="q[]" value="{{ $data['question'][0]['id'] }}" >
                        <input type="text" name="ans_{{ $qcount-1 }}">
                        @php  $acount = 1;  @endphp
                        @foreach ($data['question'][0]['answers'] as $answer)
                            <p><b>{{ $acount++ }}) </b>{{ $answer['answer'] }}
                                <input type="radio" name="radio_{{ $qcount-1 }}" class="select_ans" value="{{ $answer['id'] }}" >        
                        </p>
                        @endforeach
                    </div>
                    <br />
                @endforeach
                <div class="text-center">
                    <input type="submit" class="btn btn-info">
                </div>
            </form>
            @else
             <h3 style="color:red;" class="text-center">Questions & Answers not Available!</h3>
            @endif
        @else
            <h3 style="color:red;" class="text-center">{{ $msg }}</h3>
        @endif
    </div>

@endsection