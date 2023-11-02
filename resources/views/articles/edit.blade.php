@extends('layouts.app')

@section('content')
    <h1>Edit article #{{ $article->id }}</h1>
    <div class="row justify-content-between">
        <div class="col-4">
            <form action="{{ route('articles.update', $article) }}" method="POST">
                @method('PUT')
                <x-forms.article :article="$article">           
                </x-forms.article>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection