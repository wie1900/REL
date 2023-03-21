@extends('layouts.start')
@section('title', 'Revenue and Expense Ledger')

@section('ver')
    v.{{ $ver }}
@endsection

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Reports:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/total">Total balance</a></b></div>
    @foreach ($balance as $b)
        <div class="col-12 text-start ps-5 h6">-> <b><a href="/year/{{ $b->year }}">{{ $b->year }}</a></b></div>
    @endforeach
@endsection

@section('content')
{{-- row HEADER --}}
<div class="row fw-bold text-light border-bottom mt-0 bg-primary pt-2">
    {{-- left part --}}
    <div class="col-9">
        <div class="row">
            <div class="col-3 h5 text-center border-end border-2">Year</div>
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
            <div class="col-7 h5 border-end border-2 text-start">Add. Stats</div>
            <div class="col-5 h5">No</div>
        </div>
    </div>
</div> {{-- end row HEADER --}}

{{-- row DATA --}}
<div class="row">

    {{-- left data part --}}
    <div class="col-9 border-bottom border-1">
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
            <div class="col-3 border-end border-1 fw-bold text-center"><a href="/year/{{ $b->year }}">{{ $b->year }}</a></div>
            <div class="col-1 border-end border-1 text-center">{{ $b->no_rev }}</div>
            <div class="col-2 border-end border-1 text-end">{{ number_format($b->val_rev,2,'.',' ') }}</div>
            <div class="col-1 border-end border-1 text-center">{{ $b->no_exp }}</div>
            <div class="col-2 border-end border-1 text-end">{{ number_format($b->val_exp,2,'.',' ') }}</div>
            <div class="col-3 border-end border-1 text-end">{{ number_format($b->val_rev-$b->val_exp,2,'.',' ') }}</div>
        </div>
        @endforeach
        <div class="row border-top border-1 border-dark mt-3 py-1 fw-bold">
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
        <div class="row border-1 py-1 fw-bold">
            <div class="col-7 border-end border-bottom border-1 pb-1">Customers</div>
            <div class="col-5 border-end border-bottom border-1 pb-1 text-end pe-5">{{ $customers }}</div>
        </div>
        <div class="row fw-bold">
            <div class="col-7 border-end border-bottom border-1 pb-1">Contractors</div>
            <div class="col-5 border-end border-bottom border-1 pb-1 text-end pe-5">{{ $contractors }}</div>
        </div>
        <div class="row fw-bold">
            <div class="col-7 border-end border-bottom border-1 py-1">Avg. sales price</div>
            <div class="col-5 border-end border-1 border-bottom py-1 text-end pe-5">{{ number_format($avg_val,2,'.',' ') }}</div>
        </div>
        <div class="row fw-bold">
            <div class="col-7 border-end border-1 border-bottom py-1">Max. sales price</div>
            <div class="col-5 border-end border-1 border-bottom py-1 text-end pe-5">{{ number_format($max_val,2,'.',' ') }}</div>
        </div>
        <div class="row fw-bold">
            <div class="col-7 border-end border-bottom border-1 py-1">Min. sales price</div>
            <div class="col-5 border-end border-bottom border-1 py-1 text-end pe-5">{{ number_format($min_val,2,'.',' ') }}</div>
        </div>
    </div>

</div> {{-- end row DATA --}}
@endsection
