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
            <div class="col-3 h5 text-center border-end border-2 fw-bold">Year</div>
            <div class="col-1 h5 border-end border-2 text-center">Rev. No</div>
            <div class="col-2 h5 border-end border-2">Income</div>
            <div class="col-1 h5 border-end border-2 text-center">Exp. No</div>
            <div class="col-2 h5 border-end border-2">Costs</div>
            <div class="col-3 h5 border-end border-2 text-start">Balance</div>
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

        <div class="row mt-3 border-bottom border-1">
            <div class="col-12 fw-bold h5">Year {{ $id }} balance</div>
        </div>

        @php
                $no_rev=0;
                $no_exp=0;
                $val_rev=0;
                $val_exp=0;
        @endphp

        @foreach ($balance as $b)
            @php
                $no_rev += $b->no_rev;
                $no_exp += $b->no_exp;
                $val_rev += $b->val_rev;
                $val_exp += $b->val_exp;
            @endphp

        {{-- DATA ROWS (on the left) --}}
        <div class="row border-bottom border-1 py-1">
            <div class="col-3 border-end border-1 fw-bold text-center"><a href="/month/{{ $b->month }}">{{ $b->month }}</a></div>
            <div class="col-1 border-end border-1 text-center">{{ $b->no_rev }}</div>
            <div class="col-2 border-end border-1 text-end">{{ number_format($b->val_rev,2,'.',' ') }}</div>
            <div class="col-1 border-end border-1 text-center">{{ $b->no_exp }}</div>
            <div class="col-2 border-end border-1 text-end">{{ number_format($b->val_exp,2,'.',' ') }}</div>
            <div class="col-3 border-end border-1 text-end">{{ number_format($b->val_rev-$b->val_exp,2,'.',' ') }}</div>
        </div>
        @endforeach

        <div class="row border-top border-1 border mt-3 py-1 fw-bold">
            <div class="col-3 border-end border-1 fw-bold text-end">In Total:</a></div>
            <div class="col-1 border-end border-1 text-center">{{ $no_rev }}</div>
            <div class="col-2 border-end border-1 text-end">{{ number_format( $val_rev,2,'.',' ') }}</div>
            <div class="col-1 border-end border-1 text-center">{{ $no_exp }}</div>
            <div class="col-2 border-end border-1 text-end">{{ number_format($val_exp,2,'.',' ') }}</div>
            <div class="col-3 border-end border-1 text-end">{{ number_format($val_rev-$val_exp,2,'.',' ') }}</div>
        </div>
    </div>

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
                    @if ($b->yname == $id)
                        <div class="col-10 text-start ps-4 h6">-> <b><a href="/year/{{ $b->yname }}" class="text-danger">{{ $b->yname }}</a></b></div>
                    @else
                        <div class="col-10 text-start ps-4 h6">-> <b><a href="/year/{{ $b->yname }}">{{ $b->yname }}</a></b></div>
                    @endif
                    @endforeach
                </div>
                <div class="col-4 offset-md-1 fw-bold text-start ps-3">
                    @foreach ($balance as $b)
                    @if ($b->month == substr($id,0,7))
                        <div class="h6 fw-bold"><a class="text-danger" href="/month/{{ $b->month }}">{{ $b->month }}</a></div>
                    @else
                        <div class="h6 fw-bold"><a href="/month/{{ $b->month }}">{{ $b->month }}</a></div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div> {{-- end row DATA --}}
@endsection
