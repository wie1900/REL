@extends('layouts.start')
@section('title', 'Add Expense document')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Expenses:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/contractors">Contractors</a></b> > <b><a href="/contractors/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/expenses">List of Expenses</a></b></div>
@endsection

@section('content')
    <div class="col-12 mt-5">
        <form action="/expenses/store" method="POST">
            @csrf
            <input type="hidden" class="form-control" name="client_id" value="{{ $doc->client_id }}">
            <input type="hidden" class="form-control" name="doctype_id" value="{{ $doc->doctype_id }}">

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Client name: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control fw-bold" disabled value="{{ $client->fname }} {{ $client->name }}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Date: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="gen" value="{{ old('gen') }}" required/>
                        </div>
                    </div>
                    @if ($errors->has('gen'))
                        <span class="text-danger">{{ $errors->first('gen') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Payment Date (option): </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="paygen" value="{{ old('paygen') }}"/>
                        </div>
                    </div>
                    @if ($errors->has('paygen'))
                        <span class="text-danger">{{ $errors->first('paygen') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Inv. No: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Description: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="description" value="{{ old('description') }}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Value (brutto): </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="val" value="{{ old('val') }}" required/>
                        </div>
                    </div>
                    @if ($errors->has('val'))
                        <span class="text-danger">{{ $errors->first('val') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-5 offset-3">
                    <div class="row">
                        <div class="col-12 col-md-10 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm text-light me-1">Save New Document</button>
                            <a class="btn btn-primary text-light btn-sm" href="/contractors" role="button">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
