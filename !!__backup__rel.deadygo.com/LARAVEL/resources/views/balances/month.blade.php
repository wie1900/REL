@extends('layouts.start')
@section('title', 'Revenue and Expense Ledger')

@section('ver')
    v.{{ $ver }}
@endsection

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Reports:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/total">Total balance</a></b></div>
@endsection

@section('content')
{{-- row HEADER --}}
<div class="row fw-bold text-light border-bottom mt-0 bg-primary pt-2">
    {{-- left part --}}
    <div class="col-9">
        <div class="row">
            <div class="col-3 h5 text-center border-end border-2"><u><a class="text-light" href="/year/{{ substr($id,0,4) }}">{{ substr($id,0,4) }}</a></u>{{ substr($id,4,3) }}</div>
            <div class="col-2 h5 border-end border-2 text-center">Edit</div>
            <div class="col-2 h5 border-end border-2">Date</div>
            <div class="col-3 h5 border-end border-2 text-start">Client</div>
            <div class="col-2 h5 border-end border-2 text-start">Total</div>
        </div>
    </div>

    {{-- right part --}}
    <div class="col-3">
        <div class="row">
            <div class="col-7 h5 text-start">Go to</div>
            <div class="col-3 h5"></div>
        </div>
    </div>
</div> {{-- end row HEADER --}}

{{-- row DATA --}}
<div class="row">

    {{-- left data part --}}
    <div class="col-9">

        @if (sizeof($revs) > 0)
        <div class="row mt-3 border-bottom border-1">
            <div class="col-12 fw-bold h5">Revenues</div>
        </div>

        @php
                $no_rev=0;
                $no_exp=0;
                $val_rev=0;
                $val_exp=0;
                $count = 0;
        @endphp

        @foreach ($revs as $b)
            @php
                $count++;
                $val_rev += $b->val_rev;
            @endphp
            {{-- DATA ROWS (on the left) --}}
        <div class="row border-bottom border-1 py-1">
            <div class="col-3 border-end border-1 text-center">
                {{ $b->name }}
            </div>
            <div class="col-2 border-end border-1 text-center">

                <a href={{route('revenues_warning',['id'=>$b->id])}} class="fst-italic"><img src="/img/thrash.png" class="img-fluid thrash" alt=""></a> /
                <a href="{{route('revenues_edit',['id'=>$b->id])}}" class="fst-italic"><img src="/img/edit.png" class="img-fluid thrash" alt=""></a> /
                <a href="/revenues/{{ $b->id }}/showpdf" target="_blank"><img src="/img/eye.png" class="img-fluid thrash" alt=""></a> /
                <a href="{{route('printpdf',['id'=>$b->id])}}"><img src="/img/pdf.png" class="img-fluid thrash" alt=""></a>

            </div>

            <div class="col-2 border-end border-1 text-end">{{ $b->gen }}</div>
            <div class="col-3 border-end border-1 text-start">{{ $b->client }}</div>
            <div class="col-2 border-end border-1 text-end">{{ number_format($b->val_rev,2,'.',' ') }}</div>
        </div>
        @endforeach

        <div class="row mb-5 border-bottom border-1">
            <div class="col-3 border-end border-1 text-center fw-bold">{{ $count }}</div>
            <div class="col-2 offset-md-7 border-end border-1 text-end fw-bold">{{ number_format($val_rev,2,'.',' ') }}</div>
        </div>
        @endif

        @if (sizeof($exps) > 0)
        <div class="row mt-3 border-bottom border-1">
            <div class="col-12 fw-bold h5">Expenses</div>
        </div>

        @php
                $no_rev=0;
                $no_exp=0;
                $val_rev=0;
                $val_exp=0;
        @endphp

        @foreach ($exps as $b)
            @php
                $val_exp += $b->val_exp;
            @endphp

            {{-- DATA ROWS (on the left) --}}
            <div class="row border-bottom border-1 py-1">
                <div class="col-3 border-end border-1 text-left ps-5">
                    {{ $b->name }}
                </div>
                <div class="col-2 border-end border-1 text-center">
                    <a href="/expenses/{{ $b->id }}/warning" class="fst-italic"><img src="/img/thrash.png" class="img-fluid thrash" alt=""></a> /
                    <a href="/expenses/{{$b->id}}/edit" class="fst-italic"><img src="/img/edit.png" class="img-fluid thrash" alt=""></a>
                </div>

                <div class="col-2 border-end border-1 text-end">{{ $b->gen }}</div>
                <div class="col-3 border-end border-1 text-start">{{ $b->client }}</div>
                <div class="col-2 border-end border-1 text-end">{{ number_format($b->val_exp,2,'.',' ') }}</div>
            </div>
        @endforeach

        <div class="row border-bottom border-1">
            <div class="col-2 offset-md-10 border-end border-1 text-end fw-bold">{{ number_format($val_exp,2,'.',' ') }}</div>
        </div>
        @endif

    </div> {{-- END 9-col left DATA content--}}

    {{-- right data part --}}
    <div class="col-3">
        <div class="row mt-3 border-bottom border-1">
            <div class="col-3 offset-md-1 fw-bold h5">Years:</div>
            <div class="col-4 offset-md-1 fw-bold h5">Months:</div>
        </div>
        <div class="fw-bold">
            <div class="row pt-3">
                <div class="col-4 fw-bold text-start ps-3">
                    @foreach ($years as $b)
                    @if ($b->yname == substr($id,0,4))
                        <div class="col-10 text-start ps-4 h6">-> <b><a href="/year/{{ $b->yname }}" class="text-danger">{{ $b->yname }}</a></b></div>
                    @else
                    <div class="col-10 text-start ps-4 h6">-> <b><a href="/year/{{ $b->yname }}">{{ $b->yname }}</a></b></div>
                    @endif
                    @endforeach
                </div>
                <div class="col-4 offset-md-1 fw-bold text-start ps-3">
                    @foreach ($months as $m)
                    @if ($m->mname == substr($id,0,7))
                        <div class="h6 fw-bold"><a class="text-danger" href="/month/{{ $m->mname }}">{{ $m->mname }}</a></div>
                    @else
                        <div class="h6 fw-bold"><a href="/month/{{ $m->mname }}">{{ $m->mname }}</a></div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div> {{-- end row DATA --}}
@endsection
