@extends('layouts.admin')

@section('content')
<section id="admin-project-create">
    <div class="container-fluid">
        <div class="row text-center mb-3">
            <h3>Crea un nuovo progetto</h3>
        </div>
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="name" class="form-label">Inserisci il nome del progetto</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="image" class="form-label">Inserisci l'immagine</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="client_name" class="form-label">Inserisci il nome del cliente</label>
                <input type="text" class="form-control" id="client_name" name="client_name" value="{{old('client_name')}}">
                @error('client_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-4">
                <label for="type_id" class="form-label">Inserisci il tipo</label>
                <select class="form-select" name="type_id">
                    <option value="0">Scegli il tipo</option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="summary" class="form-label">Inserisci la descrizione</label>
                <textarea class="form-control" id="summary" name="summary" rows="3">{{ old('summary') }}</textarea>
                @error('summary')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">TORNA INDIETRO</a>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-primary" type="submit">CREA PROGETTO</button>
                </div>  
            </div>
        </form>
    </div>
</section>    
@endsection