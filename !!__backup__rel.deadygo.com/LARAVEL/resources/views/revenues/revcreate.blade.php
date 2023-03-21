@extends('layouts.start')
@section('title', 'Add Revenue document')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Revenues:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/customers">Customers</a></b> -> <b><a href="/customers/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/itemtypes">ItemTypes</a></b></b> -> <b><a href="/itemtypes/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/revenues">Revenues</a></b></div>
@endsection

@section('content')
    <div class="col-12 mt-5">
        <div class="row">
            <div class="col-12 col-md-7">
                <form action="/revenues/store" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="client_id" value="{{ $client->id }}">

                    <div class="row mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Client name: </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control fw-bold" disabled value="{{ $client->fname }} {{ $client->name }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Date: </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="gen" value="{{ old('gen') }}" required/>
                                </div>
                            </div>
                            @if ($errors->has('gen'))
                                <span class="text-danger">{{ $errors->first('gen') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3 mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Payment Date (option): </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="paygen" value="{{ old('paygen') }}"/>
                                </div>
                            </div>
                            @if ($errors->has('paygen'))
                                <span class="text-danger">{{ $errors->first('paygen') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3 mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Inv. No: </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
                            </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3 mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Description: </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" required/>
                                </div>
                            </div>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- here will be added rows with item data dynamically --}}
                    <div class="row mt-3 mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Items: </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <a class="btn btn-primary text-light btn-sm me-3" type="button" onclick="addItem({{ json_encode($itemtypes) }})">Add Item</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-end">


                        <div id="items" class="col-12 col-md-7">
                            @if($item_id != null)
                                @php $count = 0; @endphp

                                @foreach ($item_id as $it)
                                <div class="row g-1 d-flex justify-content-end">
                                    <div class="col-7">

                                        <select name="edek" grupa="item_id" class="form-select form-select mb-2" required>
                                            @foreach($itemtypes as $itypes)
                                                @if($it==$itypes->id)
                                                    <option selected value="{{ $itypes->id }}">{{ $itypes->name }}</option>
                                                @else
                                                    <option value="{{ $itypes->id }}">{{ $itypes->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-2">
                                        <input type="text" grupa="item_qty" class="form-control text-center" name="qty" value="{{ $qty[$count] }}" required/>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" grupa="item_val" class="form-control text-end pe-3" name="unitprice" value="{{ $unitprice[$count] }}" required/>
                                    </div>
                                    <div class="col-1">
                                        <div class="d-flex justify-content-end pt-1">
                                            <a class="btn btn-danger btn-sm text-light" onclick="delItem(this)" role="button">Del</a>
                                        </div>
                                    </div>
                                </div>
                                @php $count++; @endphp
                                @endforeach

                            @endif
                        </div>

                    </div>

                    <div class="row mt-3 mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12 d-flex justify-content-end">
                                    <button id="submitter" type="submit" class="btn btn-primary btn-sm text-light me-1" >Save New Document</button>
                                    <a class="btn btn-primary text-light btn-sm" href="/customers" role="button">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-5">
                <div class="row">
                    <div class="col-12 mt-1 col-md-12 border-start">
                        <h5 class="fw-bold">Invoices:</h5>
                        <div id="invoices">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    window.onload = function() {
        reorderItems();
        setSubmit();

        let in_el = document.getElementById('invoices');
        let date_el = document.querySelector('[name="gen"]');
        let name_el = document.querySelector('[name="name"]');

        date_el.addEventListener('keyup', function(e){
            showInvoices(@json($inv), in_el, date_el, name_el);
        });
    };
</script>
