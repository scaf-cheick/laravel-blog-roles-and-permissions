<div id="PostShow{{$post->id}}" class="modal">
    <div class="modal-content">
        <h4>Details</h4>
        <p>Ref              : {{$post->ref}}</p>
        <p>Title            : {{$post->title}}</p>
        <p>Slug             : {{$post->slug}}</p>
        <p>Validateur       : {{is_null($post->validator_id) ? '' : $post->validator->name }}</p>
        <br>
        </p>Description     : {!! $post->content!!}</p>
        <hr>
        <br>
        
        
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fermer</a>
    </div>
</div>