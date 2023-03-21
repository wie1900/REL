@extends('layouts.start')
@section('title', 'Edit Contractor')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Contractors:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/contractors">Contractors</a></b> > <b><a href="/contractors/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/expenses">List of Expenses</a></b></div>
@endsection

@section('content')
    <div class="col-12 mt-5">
        <form action="/contractors/update" method="POST">
            @csrf
            <input type="hidden" class="form-control" name="id" value="{{ $client->id }}">
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Name: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="name"
                            value=
                            @php
                                if(old('name') != '') { echo '"'.(old('name')).'"'; } else { echo '"'.$client->name.'"'; }
                            @endphp
                            required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">First Name: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="fname"
                            value=
                            @php
                                if(old('fname') != '') { echo '"'.(old('fname')).'"'; } else { echo '"'.$client->fname.'"'; }
                            @endphp
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Short: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="shortname"
                            value=
                            @php
                                if(old('shortname') != '') { echo '"'.(old('shortname')).'"'; } else { echo '"'.$client->shortname.'"'; }
                            @endphp
                            required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Address: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="address"
                            value=
                            @php
                                if(old('address') != '') { echo '"'.(old('address')).'"'; } else { echo '"'.$client->address.'"'; }
                            @endphp
                            required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Tax Id. No: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="nip"
                            value=
                            @php
                                if(old('nip') != '') { echo '"'.(old('nip')).'"'; } else { echo '"'.$client->nip.'"'; }
                            @endphp
                            required/>
                        </div>
                    </div>
                    @if ($errors->has('nip'))
                        <span class="text-danger">{{ $errors->first('nip') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">GenDate: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="gen"
                            value=
                            @php
                                if(old('gen') != '') { echo '"'.(old('gen')).'"'; } else { echo '"'.$client->gen.'"'; }
                            @endphp
                            required/>
                        </div>
                    </div>
                    @if ($errors->has('gen'))
                        <span class="text-danger">{{ $errors->first('gen') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-5 offset-3">
                    <div class="row">
                        <div class="col-12 col-md-10 d-flex justify-content-end">
                            <a class="btn btn-danger text-light btn-sm me-1" href="/contractors/{{ $client->id }}/warning" role="button">Delete</a>
                            <button type="submit" class="btn btn-primary btn-sm text-light me-1">Update the Contractor</button>
                            <a class="btn btn-primary text-light btn-sm me-0" href="/contractors" role="button">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
