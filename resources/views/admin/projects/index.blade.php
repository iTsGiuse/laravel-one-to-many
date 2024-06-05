@extends('layouts.admin')

@section('content')
    <section id="admin-project-index">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col">
                    <h1 class="text-center">Progetti ({{count($projects)}})</h1>
                </div>
            </div>
            <div class="row text-danger">
                <div class="col-1 text-center fst-italic">
                    <h3>Dettagli:</h3>
                </div>
                <div class="col-3 fst-italic">
                    <h3>Nome progetto:</h3>
                </div>
                <div class="col-3 fst-italic">
                    <h3>Nome cliente:</h3>
                </div>
                <div class="col-3 fst-italic">
                    <h3>Data creazione:</h3>
                </div>
                <div class="col-2 text-center fst-italic">
                    <h3>Azioni:</h3>
                </div>
            </div>
            @foreach ($projects as $project)
                <div class="row my-3">
                    <div class="col-1 text-center">
                        <a class="btn btn-primary" href="{{route('admin.projects.show', ['project' => $project->id])}}"><i class="fa-regular fa-eye"></i></a>
                    </div>
                    <div class="col-3">
                        <h5>{{$project->name}}</h5>
                    </div>
                    <div class="col-3">
                        <h5>{{$project->client_name}}</h5>
                    </div>
                    <div class="col-3">
                        <h5>{{$project->created_at}}</h5>
                    </div>
                    <div class="col-2 d-flex justify-content-center text-center">
                        <a class="btn btn-secondary me-2" href="{{route('admin.projects.edit', ['project' => $project->id])}}"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-light js-delete-btn" data-project-name="{{ $project->name }}"><i class="fa-solid fa-trash" style="color: red;"></i></button> 
                        </form>
                    </div>
                </div>
            @endforeach
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
