@extends('layouts.start')
@section('title', 'Contractors')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Contractors:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/contractors">Contractors</a></b> > <b><a href="/contractors/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/expenses">List of Expenses</a></b></div>
@endsection

@section('content')
    <div class="row fw-bold text-light border-bottom mt-0 bg-primary pt-2">
        <div class="col-5">
            <div class="row">
                <div class="col-9 h5 border-end border-2">Name</div>
                <div class="col-3 h5 border-end border-2">Short</div>
            </div>
        </div>
        <div class="col-7">
            <div class="row">
                <div class="col-6 h5 border-end border-2">Address</div>
                <div class="col-2 h5 border-end border-2">Tax Id. No</div>
                <div class="col-2 h5 border-end border-2">Date</div>
                <div class="col-2 h5 text-center">More</div>
            </div>
        </div>
    </div>
    @foreach ($clients as $client)
        <div class="row border-bottom mt-0 pt-1 rowcolor">
            <div class="col-5">
                <div class="row">
                    <div class="col-9 border-end border-1">
                        <div class="row no-gutters">
                            <div class="col-8 color">{{ $client->fname }} {{ $client->name }}</div>
                            <div class="col-4 text-end color">
                                <a class="fst-italic text-danger" href="/expenses/{{ $client->id }}/create" role="button"><img src="/img/doc.png" class="img-fluid thrash" alt=""> Exp.</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 border-end border-1 color">{{ $client->shortname }}</div>
                </div>
            </div>
            <div class="col-7">
                <div class="row mb-1">
                    <div class="col-6 border-end border-1 color">{{ $client->address }}</div>
                    <div class="col-2 border-end border-1 color">{{ $client->nip }}</div>
                    <div class="col-2 border-end border-1 color">{{ $client->gen }}</div>
                    <div class="col-2 border-end border-1 text-center color">
                        <a href="/contractors/{{ $client->id }}/warning" class="fst-italic"><img src="/img/thrash.png" class="img-fluid thrash" alt=""></a> /
                        <a href="/contractors/{{$client->id}}/edit" class="fst-italic"><img src="/img/edit.png" class="img-fluid thrash" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3">
        {!! $clients->render('pagination::bootstrap-4') !!}
    </div>
@endsection

<script>
    window.onload = function() {
        tableHighLight();
    };
</script>
