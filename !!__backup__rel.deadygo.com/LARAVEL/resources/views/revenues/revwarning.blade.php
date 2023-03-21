@extends('layouts.start')
@section('title', 'Delete Revenue document')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Revenues:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/revenues">Revenues</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/customers">Customers</a></b> -> <b><a href="/customers/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/itemtypes">ItemTypes</a></b></b> -> <b><a href="/itemtypes/create">Add</a></b></div>
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-12 col-md-10 mt-5">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h5>You really want to <span class="text-danger fw-bold">delete</span> the following revenue document?</h5>
                    <h4 class="fw-bold">{{ $doc->name }} - {{ $doc->description }} [{{ $doc->client->fname }} {{ $doc->client->name }}]</h4>
                </div>
            </div>
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <a class="btn btn-danger text-light btn-sm me-1" href="/revenues/{{ $doc->id }}/{{ $backurl }}/delete" role="button">Delete</a>
                    <a class="btn btn-primary text-light btn-sm" href="{{ url()->previous() }}" role="button">Cancel</a>
                </div>
            </div>
        </div>
    </div>
@endsection
