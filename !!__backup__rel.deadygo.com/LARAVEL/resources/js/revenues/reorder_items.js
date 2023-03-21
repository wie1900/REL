
reorderItems = function(){

    var item_id = 'item_id';
    var item_qty = 'item_qty';
    var item_val = 'item_val';

    var i=0;
    document.querySelectorAll('[grupa="' + item_id + '"]').forEach(element => {
        element.setAttribute('name','item_id['+i+']');
        i++;
    });
    i=0;

    document.querySelectorAll('[grupa="' + item_qty + '"]').forEach(element => {
        element.setAttribute('name','qty['+i+']');
        i++;
    });
    i=0;

    document.querySelectorAll('[grupa="' + item_val + '"]').forEach(element => {
        element.setAttribute('name','unitprice['+i+']');
        i++;
    });
    setSubmit();
}