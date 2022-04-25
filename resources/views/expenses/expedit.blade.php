@extends('layouts.start')
@section('title', 'Edit Expense document')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Expenses:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/contractors">Contractors</a></b> > <b><a href="/contractors/create">Add</a></b></div>
@endsection

@section('content')
    <div class="col-12 mt-5">
        <form action="/expenses/update" method="POST">
            @csrf
            <input type="hidden" class="form-control" name="id" value="{{ $doc->id }}">
            <input type="hidden" class="form-control" name="doctype_id" value="{{ $doc->doctype_id }}">

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Client name: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                        <select name="client_id" class="form-select form-select fw-bold">
                            @foreach ($clients as $client)

                                @if(old('client_id') != '') {
                                    @if(old('client_id')==$client->id){
                                        <option value="{{$client->id}}" selected="">{{$client->name}} {{$client->fname}}</option>
                                    } @else {
                                        <option value="{{$client->id}}">{{$client->name}} {{$client->fname}}</option>
                                    }
                                    @endif
                                } @else {
                                    @if($client->id == $doc->client->id){
                                        <option value="{{$client->id}}" selected="">{{$client->name}} {{$client->fname}}</option>
                                    } @else {
                                        <option value="{{$client->id}}">{{$client->name}} {{$client->fname}}</option>
                                    }
                                    @endif
                                }
                                @endif

                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Date: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="gen" value="{{ old('gen', $doc->gen) }}" required/>
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
                            <input type="text" class="form-control" name="paygen"
                            value=
                            @php
                                if(old('paygen') != '') { echo '"'.(old('paygen')).'"'; } else { echo '"'.$doc->paygen.'"'; }
                            @endphp
                            />
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
                            <input type="text" class="form-control" name="name"
                            value=
                            @php
                                if(old('name') != '') { echo '"'.(old('name')).'"'; } else { echo '"'.$doc->name.'"'; }
                            @endphp
                            required/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Description: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="description"
                            value=
                            @php
                                if(old('description') != '') { echo '"'.(old('description')).'"'; } else { echo '"'.$doc->description.'"'; }
                            @endphp
                            required/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Value (brutto): </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="val"
                            value=
                            @php
                                if(old('val') != '') { echo '"'.(old('val')).'"'; } else { echo '"'.$doc->val.'"'; }
                            @endphp
                            required/>
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
                            <a class="btn btn-danger text-light btn-sm me-1" href="/expenses/{{ $doc->id }}/warning" role="button">Delete</a>
                            <button type="submit" class="btn btn-primary btn-sm text-light me-1">Update the Document</button>
                            <a class="btn btn-primary text-light btn-sm" href="/month/{{ substr($doc->gen,0,7) }}" role="button">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
