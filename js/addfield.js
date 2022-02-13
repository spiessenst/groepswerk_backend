
    let i = 0;

    function addtrack(id) {
    let element = id.parentElement.id;
    let itm = document.getElementById(element);
    let cln = itm.cloneNode(true);
    itm.id = "trackrow_"+ i;

    i++;

    cln.getElementsByTagName('input')[0].id = "track_" + i;
    cln.getElementsByTagName('input')[0].value = "";
    cln.getElementsByTagName('input')[1].id = "seconds_" + i ;
    cln.getElementsByTagName('input')[1].value = "";


    document.getElementById("tracks").appendChild(cln);
}

    function deletetrack(id) {
    let element = id.parentElement.id;
    document.getElementById(element).remove();
}



