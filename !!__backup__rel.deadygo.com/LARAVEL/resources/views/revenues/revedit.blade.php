@extends('layouts.start')
@section('title', 'Edit Revenue document')

@section('subleft')
    <div class="h3 my-3 border-bottom text-start ps-5">Revenues:</div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/revenues">Revenues</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/customers">Customers</a></b> -> <b><a href="/customers/create">Add</a></b></div>
    <div class="col-12 text-start ps-4 h6">-> <b><a href="/itemtypes">ItemTypes</a></b></b> -> <b><a href="/itemtypes/create">Add</a></b></div>
@endsection

@section('content')
    <div class="col-12 mt-5">
        <div class="row">
            <div class="col-12 col-md-7">
                <form action="/revenues/update" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="doc_id" value="{{ $doc->id }}">
                    <input type="hidden" class="form-control" name="backurl" value="{{ $backurl }}">

                    <div class="row mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Client name: </div>
                        <div class="col-12 col-md-7">
                            <select name="client_id" class="form-select form-select mb-2 fw-bold">
                                @foreach ($clients as $client)

                                    @if(old('client_id') != '')
                                        @if(old('client_id')==$client->id)
                                            <option value="{{$client->id}}" selected="">{{$client->name}} {{$client->fname}}</option>
                                        @else
                                            <option value="{{$client->id}}">{{$client->name}} {{$client->fname}}</option>
                                        @endif
                                    @else
                                        @if($client->id == $doc->client->id)
                                            <option value="{{$client->id}}" selected="">{{$client->name}} {{$client->fname}}</option>
                                        @else
                                            <option value="{{$client->id}}">{{$client->name}} {{$client->fname}}</option>
                                        @endif
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Date: </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="gen" value="{{ old('gen', $doc->gen) }}" required/>
                                </div>
                            </div>
                            @if ($errors->has('gen'))
                                <span class="text-danger">{{ $errors->first('gen') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Payment Date (option): </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="paygen" value="{{ old('paygen', $doc->paygen) }}"/>
                                </div>
                            </div>
                            @if ($errors->has('paygen'))
                                <span class="text-danger">{{ $errors->first('paygen') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Inv. No: </div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $doc->name) }}" required/>
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-end">
                        <div class="col-12 col-md-4 fw-bold text-end align-self-center">Description:</div>
                        <div class="col-12 col-md-7">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" name="description" value="{{ old('description', $doc->description) }}" required/>
                                </div>
                            </div>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-end">
                        <div class="col-12 col-md-2 fw-bold text-end align-self-center">Items:</div>
                        <div class="col-12 col-md-7">
                            <a id="additembutton" class="btn btn-primary text-light btn-sm me-3" type="button" onclick="addItem({{ json_encode($itemtypes) }})">Add Item</a>
                        </div>
                    </div>

                    {{-- here added dynamically rows with item data --}}
                    <div class="row mb-3 d-flex justify-content-end">
                        <div id="items" class="col-12 col-md-7">

                            @php $i=0; @endphp

                            @if($item_id == null)
                                @foreach ($doc->items as $item)
                                    <div class="row g-1 d-flex justify-content-end">
                                        <div class="col-7">
                                            <select grupa="item_id" name="item_id[{{ $i }}]" class="form-select form-select mb-2" required>
                                                @foreach ($itemtypes as $it)
                                                    @if($item->itemtype->id == $it->id)
                                                        <option value="{{$it->id}}" selected="">{{$it->name}}</option>
                                                    @else
                                                        <option value="{{$it->id}}">{{$it->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" grupa="item_qty" class="form-control text-center" name="qty" value="{{ old('qty'[$i],$item->qty) }}" required/>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" grupa="item_val" class="form-control text-end pe-3" name="unitprice" value="{{ old('unitprice[$i]',$item->unitprice) }}" required/>
                                        </div>
                                        <div class="col-1">
                                            <div class="d-flex justify-content-end pt-1">
                                                <a class="btn btn-danger btn-sm text-light" onclick="delItem(this)" role="button">Del</a>
                                            </div>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach
                            @else
                                @php $count = 0; @endphp

                                @foreach($item_id as $it)
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
                    {{-- end of dynamically added data --}}

                    <div class="row mt-3 mb-2 d-flex justify-content-end">
                        <div class="col-12 col-md-5 offset-3 d-flex justify-content-end">
                            <a class="btn btn-danger text-light btn-sm me-1" href="/revenues/{{ $doc->id }}/warning" role="button">Delete</a>
                            <button id="submitter" type="submit" class="btn btn-primary btn-sm text-light me-1" onclick="reorderItems()">Update the Document</button>
                            <a class="btn btn-primary text-light btn-sm" href="/month/{{ substr($doc->gen,0,7) }}" role="button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-5">

                <div class="row">
                    <div class="col-12 mt-1 col-md-4 border-start">
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

        showInvoices(@json($inv), in_el, date_el, '');

        date_el.addEventListener('keyup', function(e){
            showInvoices(@json($inv), in_el, date_el, '');
        });
    };
</script>
