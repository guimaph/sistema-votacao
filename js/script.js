function mascararCpf(inp){

    var val = inp.value;
    
    if(isNaN(val[val.length-1])){ /*permitir digitar somente números*/
       inp.value = val.substring(0, val.length-1);
       return;
    }
    
    inp.setAttribute("maxlength", "14");
    if (val.length == 3 || val.length == 7) inp.value += ".";
    if (val.length == 11) inp.value += "-";
 
}

/*alternar tela de votação e resultados*/
function swithDocument(doc) {
    if (doc == 'result') {
        top.window.document.getElementById('vote_container').classList.add('d-none')
        top.window.document.getElementById('result_container').classList.remove('d-none')
    } else {
        top.window.document.getElementById('vote_container').classList.remove('d-none')
        top.window.document.getElementById('result_container').classList.add('d-none')
    }
}

window.history.forward();
// function noBack() {
//     window.history.forward();
// }

/*não permitir submit ao atualizar a página, somente ao clicar no botão "votar"*/
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}