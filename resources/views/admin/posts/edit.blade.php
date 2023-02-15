@extends('layouts.admin')

@section('title') Update a post @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Update a post</span>
                        <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="file-field input-field">
                                <div class="btn green">
                                   <span>IMAGE <i class="material-icons white-text left">add_a_photo</i></span>
                                   <input type="file" name="picture" id="picture">
                                </div>

                                <div class="file-path-wrapper">
                                    <input class="file-path validate" name="picture" id="picture" type="text" placeholder="Image de mise en avant ">
                                    @if ($errors->has('picture'))
                                        <span class="helper-text red-text" >{{ $errors->first('picture') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input-field">
                                <i class="material-icons grey-text prefix left">code</i>
                                <label for="title" class="active">Title <span class="red-text">*</span></label>
                                <input type="text" id="title" name="title" required="" value="{{ $post->title }}">
                                @if ($errors->has('title'))
                                    <span class="helper-text red-text" >{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="input-field">
                                <i class="material-icons grey-text prefix left">local_offer</i>
                                <select name="category_id" required="">
                                    @foreach($categories as $key => $type)
                                        <option value="{{$type->id}}" {{ $post->category_id === $type->id ? 'selected' : '' }}>{{$type->title}}</option>
                                    @endforeach
                                </select> 
                                <label>Category <span class="red-text">*</span></label>
                                @if ($errors->has('category_id'))
                                    <span class="helper-text red-text" >{{ $errors->first('category_id') }}</span>
                                @endif    
                            </div>

                            <div class="input-field">
                                <i class="material-icons grey-text prefix left">mood</i>
                                <textarea id="body" name="content" class="materialize-textarea" required style="height: 100px">{{ $post->content }}</textarea> 
                                <label class="active">Description <span class="red-text">*</span></label>
                                @if ($errors->has('content'))
                                    <span class="helper-text red-text" >{{ $errors->first('content') }}</span>
                                @endif  
                            </div>

                            {{-- <div class="input-field">
                                <select name="status" required="" class="browser-default">
                                    <option value="" disabled="">Choisissez le status</option>
                                    <option value="true" {{ $post->status == true ? 'selected' : '' }}>Activé</option>
                                    <option value="false" {{ $post->status == false ? 'selected' : '' }}>Désactivé</option>
                                </select> 
                                @if ($errors->has('status'))
                                    <span class="helper-text red-text" >{{ $errors->first('status') }}</span>
                                @endif
                            </div> --}}

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

    <script src="https://cdn.ckeditor.com/4.11.1/basic/ckeditor.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function(){

            CKEDITOR.replace( 'body' );

            $(document).on('submit','form',function(){
                $('#btn_submit').attr('disabled', 'true');
            });
        });

    </script>


@endpush