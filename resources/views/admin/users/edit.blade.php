@extends('layouts.admin')

@section('title') Update user @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Change <b>{{$user->name}}</b> role</span>
                        <form action="{{route('user.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="input-field">
                                <i class="material-icons grey-text prefix left">local_offer</i>
                                <select multiple name="role_id[]" required="">
                                    @foreach($roles as $key => $type)
                                        <option value="{{$type->name}}" {{ $user->roles->contains($type->id) ? 'selected' : '' }}>{{$type->name}}</option>
                                    @endforeach 
                                </select> 
                                <label>Role <span class="red-text">*</span></label>
                                @if ($errors->has('role_id.*'))
                                    <span class="helper-text red-text" >{{ $errors->first('role_id.*') }}</span>
                                @endif    
                            </div>

                            <br>
                            <button class="waves-effect waves-dark green btn medium center" type="submit" id="btn_submit">UPDATE <i class="material-icons white-text right small">done_all</i></button>
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