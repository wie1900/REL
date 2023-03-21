@extends('layouts.start')
@section('title', 'Revenue and Expense Ledger')

@section('ver')

@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row mt-5 mb-3">
                    <div class="col-10 offset-md-1 text-start">
                        <h5 class="fw-bold">Saved PDF Invoice files:</h5>
                        @php
                            $path = public_path().'/pdf/';
                            $files = scandir($path);
                        @endphp
                        @foreach($files as $f)
                            @if($f != '.' && $f != '..')
                            <div><a href="{{ url('/pdf/'.basename($f)) }}" target="_blank">{{ basename($f) }}</a></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
