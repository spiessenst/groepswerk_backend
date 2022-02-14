
    let i = 0;

    function addtrack(id) { //button element

    let element = id.parentElement.id; //trackrow

    let itm = document.getElementById(element); // trackrow div

    let cln = itm.cloneNode(true);
    itm.id = "trackrow_"+ i; //clone trackrow with new id

    i++;

    cln.getElementsByTagName('input')[0].id = "track_" + i; //new track id
    cln.getElementsByTagName('input')[0].value = ""; //  empty value
    cln.getElementsByTagName('input')[1].id = "seconds_" + i ;
    cln.getElementsByTagName('input')[1].value = "";


    document.getElementById("tracks").appendChild(cln); // new track row
}

    function deletetrack(id) {
    let element = id.parentElement.id; // trackrow
    document.getElementById(element).remove(); // remove trackrow
}



