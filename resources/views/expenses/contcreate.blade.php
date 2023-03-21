@extends('layouts.start')
@section('title', 'Add a New Contractor')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Contractors:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/contractors">Contractors</a></b> > <b><a href="/contractors/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/expenses">List of Expenses</a></b></div>
@endsection

@section('content')
    <div class="col-12 mt-5">
        <form action="/contractors/store" method="POST">
            @csrf
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Name: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">First Name: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="fname" value="{{ old('fname') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Short: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="shortname" value="{{ old('shortname') }}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Address: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-2 offset-1 fw-bold text-end align-self-center">Tax Id. No: </div>
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <input type="text" class="form-control" name="nip" value="{{ old('nip') }}" />
                        </div>
                    </div>
                    @if ($errors->has('nip'))
                        <span class="text-danger">{{ $errors->first('nip') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-5 offset-3">
                    <div class="row">
                        <div class="col-12 col-md-10 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm text-light me-1">Save New Contractor</button>
                            <a class="btn btn-primary text-light btn-sm me-0" href="/contractors" role="button">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
