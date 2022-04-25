
addItem = function(itemtypes) {
    var item_id = 'item_id';
    var item_qty = 'item_qty';
    var item_val = 'item_val';

    var newItem =
        '<div><div class="row g-1 d-flex justify-content-end"><div class="col-7">'+
        '<select name="edek" grupa="'+ item_id +'" class="form-select form-select mb-2" required>';
        
        itemtypes.forEach(el => {
            newItem += '<option value="' + el.id + '">' + el.name + '</option>';
        }); 

        newItem += '</select>'+
        '</div>'+
        '<div class="col-2">'+
        '<input type="text" grupa="'+ item_qty +'" class="form-control text-center" name="qty" value="" required/>'+
        '</div>'+
        '<div class="col-2">'+
        '<input type="text" grupa="'+ item_val +'" class="form-control text-end pe-3" name="unitprice" value="" required/>'+
        '</div>'+
        '<div class="col-1">'+
        '<div class="d-flex justify-content-end pt-1">'+
        '<a class="btn btn-danger btn-sm text-light" onclick="delItem(this)" role="button">Del</a>'+
        '</div>'+
        '</div>'+
        '</div></div>';

    let element = document.createElement('div');
    element.innerHTML = newItem;
    document.getElementById("items").appendChild(element);
    reorderItems();
}