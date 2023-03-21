
showInvoices = function(inv, in_el, date_el, name_el){

    var numbers = [];
    in_el.innerHTML = '';
    inv.forEach(el => {
        var target = el.name;

        if(target.substr(1,1)=='/'){
            target = "0"+target;
        }

        if(target.substr(4,1)=='/'){
            target = target.substr(0,3)+'0'+target.substr(3);
        }

        var date = date_el.value;
        if(date.substr(0,4) == target.substr(6,10) && date.substr(5,2) == target.substr(3,2)) {
            numbers.push(target);
            let diw = document.createElement('div');
            diw.innerHTML = target+" ("+el.gen+")";
            in_el.appendChild(diw);
        }
    });

    let nextnumber = '';
    let pattern = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;

    if(numbers.length > 0){
        nextnumber = numbers[numbers.length-1].substr(0,2);
        nextnumber++;
        nextnumber += numbers[numbers.length-1].substr(2);
    } else if(pattern.test(date_el.value) == true) {
        nextnumber = '01/' + date_el.value.substr(5,2) + '/' + date_el.value.substr(0,4);
    }

    if(nextnumber.length == 9) nextnumber = '0' + nextnumber;
    name_el.value = nextnumber;

}
