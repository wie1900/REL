@extends('layouts.start')
@section('title', 'ItemType Editing')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Revenues:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/customers">Customers</a></b> -> <b><a href="/customers/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/itemtypes">ItemTypes</a></b></b> -> <b><a href="/itemtypes/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/revenues">List of Revenues</a></b></div>
@endsection

@section('content')
    <div class="col-12 mt-5">
        <form action="/itemtypes/update" method="POST">
            @csrf
            <input type="hidden" class="form-control" name="id" value="{{ $itemtype->id }}">

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Name: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $itemtype->name }}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Type: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="type" value="{{ $itemtype->type }}" required/>
                        </div>
                    </div>
                    @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-5 offset-3">
                    <div class="row">
                        <div class="col-12 col-md-10 d-flex justify-content-end">
                            <a class="btn btn-danger text-light btn-sm me-1" href="/itemtypes/{{ $itemtype->id }}/warning" role="button">Delete</a>
                            <button type="submit" class="btn btn-primary btn-sm text-light me-1">Update ItemType</button>
                            <a class="btn btn-primary text-light btn-sm me-3" href="/itemtypes" role="button">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
