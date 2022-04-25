@extends('layouts.start')
@section('title', 'Revenue and Expense Ledger')

@section('ver')
    v.{{ $ver }}
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row mt-5 mb-3">
                    <div class="col-10 d-flex justify-content-center text-center">
                        <div class="col-3 me-4">
                            <a href="/total"><div class="col-12 py-3 btn btn-primary fs-3 text-light">Reports</div></a>
                            <div class="col-12 border-bottom border-primary border-3 rounded border-left">
                                <div class="py-3 px-2 border-start border-end border-1">
                                    Balances (summaries in total, by year / month), editing.
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <a href="/revenues"><div class="col-12 py-3 btn btn-primary fs-3 text-light">Revenues</div></a>
                            <div class="col-12 border-bottom border-primary border-3 rounded border-left">
                                <div class="py-3 px-2 border-start border-end border-1">
                                    Total list of sold services (with PDF preview).
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mx-4">
                            <a href="/expenses"><div class="col-12 py-3 btn btn-primary fs-3 text-light">Expenses</div></a>
                            <div class="col-12 border-bottom border-primary border-3 rounded border-left">
                                <div class="py-3 px-2 border-start border-end border-1">
                                    Total list of purchased products / services.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-3">
                    <div class="col-10 d-flex justify-content-center text-center">
                        <div class="col-3 me-4">
                            <a href="/customers"><div class="col-12 py-3 btn btn-primary fs-3 text-light">Customers</div></a>
                            <div class="col-12 border-bottom border-primary border-3 rounded border-left">
                                <div class="py-3 px-2 border-start border-end border-1">
                                    List of clients buying our services.
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <a href="/contractors"><div class="col-12 py-3 btn btn-primary fs-3 text-light">Contractors</div></a>
                            <div class="col-12 border-bottom border-primary border-3 rounded border-left">
                                <div class="py-3 px-2 border-start border-end border-1">
                                    List of clients selling products to us.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-3">
                    <div class="col-10 offset-md-1 text-start">
                        <h5 class="fw-bold">Legend</h5>
                        <div><img src="/img/eye.png" class="img-fluid thrash" alt=""> &mdash; PDF preview (for created revenues only)</div>
                        <div><img src="/img/pdf.png" class="img-fluid thrash" alt=""> &mdash; PDF saving to public folder '/pdf' (for created revenues only)</div>
                        <div><img src="/img/edit.png" class="img-fluid thrash" alt=""> &mdash; Edit saved item</div>
                        <div class="mb-3"><img src="/img/thrash.png" class="img-fluid thrash" alt=""> &mdash; Delete saved item</div>
                        <div><img src="/img/doc.png" class="img-fluid thrash" alt=""><span class="text-primary fst-italic fw-bold"> Rev.</span> &mdash; Create Revenue document for the given customer (on the Customer list)</div>
                        <div><img src="/img/doc.png" class="img-fluid thrash" alt=""><span class="text-danger fst-italic"> Exp.</span> &mdash; Add Expense document from the given contractor (on the Contractor list)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
