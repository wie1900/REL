
setSubmit = function(){
    var but = document.getElementById('submitter');

    if(document.querySelector('[name="item_id[0]"]') != null){
        but.disabled = false;
        console.log("Element exists");
    } else {
        but.disabled = true;
        console.log("Element does not exist");
    }
}
