@extends('layouts.admin')

@section('title') Update a category @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Update a category</span>
                        <form action="{{route('category.update', $category->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="input-field">
                                <i class="material-icons grey-text prefix left">code</i>
                                <label for="title" class="active">Titre <span class="red-text">*</span></label>
                                <input type="text" id="title" name="title" required="" value="{{ $category->title }}">
                                @if ($errors->has('title'))
                                    <span class="helper-text red-text" >{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <br>
                            <button class="waves-effect waves-dark green btn medium center" type="submit" id="btn_submit">SAVE <i class="material-icons white-text right small">done_all</i></button>
                        </form>
                  
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')

    @include('layouts.partials._notification')

    <script type="text/javascript">
        
        $(document).ready(function(){

            $(document).on('submit','form',function(){
                $('#btn_submit').attr('disabled', 'true');
            });
        });

    </script>


@endpush