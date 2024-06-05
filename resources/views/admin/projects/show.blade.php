@extends('layouts.admin')

@section('content')
    <section id="admin-project-show">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col">
                    <h1 class="text-center text-danger">Dettagli del progetto: {{$project->name}}</h1>
                </div>
            </div>
            <div class="row my-5">
                <div class="col d-flex justify-content-center">
                    <div class="card text-center">
                            @if ($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="card-img-top">
                            @else
                                <small>No image</small>
                            @endif
                            <div id="btn-edit" class="d-flex">
                                <a class="btn btn-light me-2" href="{{ route('admin.projects.edit', ['project' => $project->id]) }}"><i class="fa-solid fa-pencil"></i></a>
                                <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light js-delete-btn" data-project-name="{{ $project->name }}"><i class="fa-solid fa-trash" style="color: red;"></i></button> 
                                </form>
                            </div>
                        <div class="card-body">
                            <h5 class="card-title my-2">{{$project->name}}</h5>
                            <p class="card-text my-2">TIPO: {{$project->type->name}}</p>
                            <p class="card-text my-2">{{$project->client_name}}</p>
                            <p class="card-text my-2">{{$project->summary}}</p>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col text-center">
                    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Torna alla lista dei progetti</a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Conferma eliminazione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="button" id="modal-confirm-deletion" class="btn btn-danger">Elimina</button>
                </div>
            </div>
            </div>
        </div>
    </section>
@endsection