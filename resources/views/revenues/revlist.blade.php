@extends('layouts.start')
@section('title', 'Revenue documents')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Revenues:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/customers">Customers</a></b> -> <b><a href="/customers/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/itemtypes">ItemTypes</a></b></b> -> <b><a href="/itemtypes/create">Add</a></b></div>
@endsection

@section('content')
    <div class="row fw-bold text-light border-bottom mt-0 bg-primary pt-2">
        <div class="col-7">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-7 h5 border-end border-2">Invoice No.</div>
                        <div class="col-5 h5 border-end border-2">Date</div>
                    </div>
                </div>
                <div class="col-3 h5 border-end border-2">Short</div>
                <div class="col-5 h5 border-end border-2">Description</div>
            </div>
        </div>

        <div class="col-3 h5 border-end border-2">Address</div>
        <div class="col-2">
            <div class="row">
                <div class="col-5 h5 border-end border-2 text-center">Total</div>
                <div class="col-7 h5 text-center">
                    PDF / Report
                </div>
            </div>
        </div>
    </div>

    @foreach ($docs as $doc)
        <div class="row border-bottom mt-0 pt-1 rowcolor">
            <div class="col-7">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-7 border-end border-1 color">{{ $doc->name }}</div>
                            <div class="col-5 border-end border-1 color">{{ $doc->gen }}</div>
                        </div>
                    </div>
                    <div class="col-3 border-end border-1 color">{{ $doc->client->shortname }}</div>
                    <div class="col-5 border-end border-1 color">{{ $doc->description }}</div>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-12 border-end border-1 color">{{ $doc->client->address }}</div>
                </div>
            </div>
            <div class="col-2">
                <div class="row mb-1">
                    <div class="col-5 border-end border-1 text-end color">{{ number_format($doc->getTotalPrice(),2,'.','') }}</div>
                    <div class="col-7 border-end border-1 text-center color">
                        <a href="/revenues/{{ $doc->id }}/showpdf" target="_blank"><img src="/img/eye.png" class="img-fluid thrash" alt=""></a> /
                        <a href="/month/{{ substr($doc->gen,0,7) }}" target="_blank" class="fw-bold">Report</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3">
        {!! $docs->render('pagination::bootstrap-4') !!}
    </div>
@endsection

<script>
    window.onload = function() {
        tableHighLight();
    };
</script>
