@csrf
<label for="title">List Title</label>
<input name="title" type="text" id="title" value="
@if(isset($post->title))
{{ $post->title }}
@else
{{ old('title') }}
@endif
">
<textarea name="body" cols="45" rows="20">
@if(isset($post->body))
{{ $post->body }}
@else
{{ old('body') }}
@endif</textarea>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <small class="error">{{ $error }}</small>
    @endforeach
@endif
<input class="button" type="submit" value="
@if(isset($post->title))
Update
@else
Submit
@endif
">
