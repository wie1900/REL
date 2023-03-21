@extends('layouts.start')
@section('title', 'Item Type List')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Item Types:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/customers">Customers</a></b> -> <b><a href="/customers/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/itemtypes">ItemTypes</a></b></b> -> <b><a href="/itemtypes/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/revenues">List of Revenues</a></b></div>
@endsection

@section('content')
    <div class="row fw-bold text-light border-bottom mt-0 bg-primary pt-2">
        <div class="col-7">
            <div class="row">
                <div class="col-4 h5 border-end border-2"></div>
                <div class="col-5 h5 border-end border-2">Name</div>
                <div class="col-3 h5 border-end border-2">Type</div>
            </div>
        </div>
        <div class="col-1 h5 border-end border-2">More</div>
        <div class="col-4"></div>
    </div>

    @foreach ($itemtypes as $item)
        <div class="row border-bottom mt-0 py-1">
            <div class="col-7">
                <div class="row">
                    <div class="col-4 border-end border-1"></div>
                    <div class="col-5 border-end border-1">{{ $item->name }}</div>
                    <div class="col-3 border-end border-1">{{ $item->type }}</div>
                </div>
            </div>
            <div class="col-1 border-end border-1 text-center">
                <a href="/itemtypes/{{ $item->id }}/warning" class="fst-italic"><img src="/img/thrash.png" class="img-fluid thrash" alt=""></a> /
                <a href="/itemtypes/{{ $item->id }}/edit" class="fst-italic"><img src="/img/edit.png" class="img-fluid thrash" alt=""></a>
            </div>
            <div class="col-4"></div>
        </div>
    @endforeach
@endsection
