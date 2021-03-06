function hide(id){
    $('#' + id).hide();
}

function show(id){
    $('#' + id).show();
}

function clear(id) {
    input = $('#' + id);
    clon = input.clone();
    input.replaceWith(clon);
}

function hideAndClear(id){
    clear(id);
    hide(id);
}

function confirmCancelAndRedirect(text, url){
    if(confirm(text))
        redirect(url);
}

function confirmCancelEditCouch(id){
    if(confirm("¿Cancelar la modificación del couch?")){
        redirect("editCouch.php?id="+id);
    }
}

function error(id){
    $('#' + id).css('border', '3px solid rgba(188, 16, 16, 0.72)');
}
function noError(id){
    $('#' + id).removeAttr('style');
}
function showError(option){
    switch(option){
        case 'noIdError':
            alert("No se indicó un couch para mostrar. Presione aceptar para volver al inicio.");
            setTimeout(window.location = "index.php", 5000);
            break;
        case 'couchError':
            alert("Couch inexistente. Presione aceptar para volver al inicio.");
            setTimeout(window.location = "index.php", 5000);
            break;
    }
}
function form(id){
    return $('#' + id);
}

function focus(id){
    $('#' + id).focus();
}

function value(id){
    return $('#' + id).val();
}
function inputValue(name){
    return $('input[name='+name+']').val();
}
function textareaValue(name){
    return $('textarea[name='+name+']').val();
}

function formValidation(option){
    switch(option){
        case "rate":
            rating= inputValue("rating");
            comment= textareaValue('comment');
            if(rating== null || rating == ""){
                alert("El puntaje es obligatorio y debe ser un valor entre 1 y 5");
                focus("rating");
                return false;
            }else if(comment == null || comment == "" || comment.lenght < 4){
                alert("El comentario es obligatorio y debe tener al menos 4 caracteres");
                focus("comment");
                return false;
            } else
                return true;
        break;
        case "request":
            fdate= inputValue("fdate");
            tdate= inputValue("tdate");
            amount= inputValue("amount");
            maxAmount= inputValue("maxAmount");
            today= new Date().toJSON().slice(0,10);
            if(fdate == "" || Date.parse(fdate) < Date.parse(today)){
                alert("La fecha del campo 'Desde' debe ser una fecha válida.");
                focus("fdate");
                return (false);
            }
            else if(tdate == "" || Date.parse(tdate) <= Date.parse(today)){
                alert("La fecha del campo 'Hasta' debe ser una fecha válida.");
                focus("tdate");
                return (false);
            }
            else if(Date.parse(tdate) <= Date.parse(fdate)){
                alert("La fecha del campo 'Hasta' debe ser una fecha mayor a la del campo 'Desde'.");
                focus("tdate");
                return (false);
            }
            else if(amount == "" || parseInt(amount) <= 0){
                alert("La cantidad de personas debe contener un valor válido.");
                focus("amount");
                return (false);
            }
            else if(parseInt(amount) > parseInt(maxAmount)){
                alert("La cantidad de personas debe ser menor o igual a la capacidad maxima de la publicación.");
                focus("amount");
                return (false);
            }
            return (true);
        break;
        case "couch":
            title= value("title1");
            capacity= value("capacity");
            place= value("place");
            description= value("description");
            if(title === "" || !(isNaN(title))){
                focus("title1");
                alert("El título debe contener caracteres alfanumericos.");
                return (false);
            }
            if(capacity === "" || isNaN(capacity) || parseInt(capacity) <= 0){
                focus("capacity");
                alert("La capacidad debe contener un valor válido.");
                return (false);
            }
            if(place === "" || !(isNaN(place))){
                focus("place");
                alert("El lugar debe contener caracteres alfanumericos.");
                return (false);
            }
            if(description === "" || !(isNaN(description))){
                focus("description");
                alert("La descripción debe contener caracteres alfanumericos.");
                return (false);
            }
            return (true);
            break;
        case "search":
            tag = document.searcher.tag.value;
            if(tag == null || tag.length == 0){
                alert("Debe indicar por lo menos una etiqueta para buscar. Pulse aceptar para volver a intentar.");
                document.searcher.tag.focus();
                return false;
            }
            else 
                return true;
        break;
            
        case "question":
            tag = document.question.questionBox.value;
            if(tag == null || tag.length < 20){
                alert("Debe escribir una pregunta con 20 caracteres minimo y 150 como maximo. Pulse aceptar para volver a intentar.");
                document.question.questionBox.focus();
                return false;
            }
            else 
                return true;
        break;
            
        case "profile":
            lname= document.profile.lname.value;        
            fname= document.profile.fname.value;
            phonen= document.profile.phonen.value;
            bdate= document.profile.bdate.value;
            today= new Date().toJSON().slice(0,10);
            if (lname == null || lname.length == 0 || !(isNaN(lname))){
                alert("El campo apellido es necesario para continuar. Debe ingresarse correctamente. Pulse aceptar para volver a intentar.");
                document.profile.lname.focus();
                return false;
            } 
            else if(fname == null || fname.length == 0 || !(isNaN(fname))){
                alert("El campo nombre es necesario para continuar. Debe ingresarse correctamente. Pulse aceptar para volver a intentar.");
                document.profile.fname.focus();
                return false;
            }
            else if(phonen == null || phonen.length == 0 || isNaN(phonen)){
                alert("El campo teléfono es necesario para continuar. Debe ingresarse correctamente. Pulse aceptar para volver a intentar.");
                document.profile.fname.focus();
                return false;
            }
            else if(bdate == null || Date.parse(bdate) > Date.parse(today)){
                alert("Debe ingresar una fecha de nacimiento valida para continuar. Pulse aceptar para volver a intentar.");
                document.profile.bdate.focus();
                return false;
            } else
                return true;
        break;
        
        case 'premium':
            cardn= document.premium.cardn.value;
            owner= document.premium.owner.value;
            expd= document.premium.expd.value;
            scode= document.premium.scode.value;
            adress= document.premium.adress.value;
            city= document.premium.city.value;
            prov= document.premium.province.value;
            zcode= document.premium.zcode.value;
            if(cardn == null || cardn.length == 0 || isNaN(cardn)){
                alert("El campo Numero de tarjeta es necesario y debe escribirse correctamente.");
                document.premium.cardn.focus();
                return false;
            }
            else if(owner == null || owner.length == 0 || !(isNaN(owner))){
                alert("El campo Titular es necesario y debe escribirse correctamente.");
                document.premium.owner.focus();
                return false;
            }
            else if(expd == null || expd.length == 0){                
                alert("El campo Vencimiento es necesario y debe escribirse correctamente.");
                document.premium.expd.focus();
                return false;
            } 
            else if(isNaN(expd.charAt(0))|| isNaN(expd.charAt(1))|| expd.charAt(2) != '/' || isNaN(expd.charAt(3))|| isNaN(expd.charAt(4))){
                alert("Escriba el vencimiento de la tarjeta correctamente. Ej: 10/05 (MM/AA)");
                document.premium.expd.focus();
                return false;
            }
            else if(scode == null || scode.length == 0 || isNaN(scode)){
                alert("El campo Numero de seguridad es necesario y debe escribirse correctamente.");
                document.premium.scode.focus();
                return false;
            }
            else if(adress == null || adress.length == 0){
                alert("El campo Direccion es necesario y debe escribirse correctamente.");
                document.premium.adress.focus();
                return false;
            }
            else if(city == null || city.length == 0 || !(isNaN(city))){
                alert("El campo Ciudad es necesario y debe escribirse correctamente.");
                document.premium.city.focus();
                return false;
            }
            else if(prov == null || prov.length == 0 || !(isNaN(prov))){
                alert("El campo Provincia es necesario y debe escribirse correctamente.");
                document.premium.province.focus();
                return false;
            }
            else if(zcode == null || zcode.length == 0 || isNaN(zcode)){
                alert("El campo Codigo postal es necesario y debe escribirse correctamente.");
                document.premium.zcode.focus();
                return false;
            }else
                return true;
            break;            
        case 'register':
                lname= document.register.lname.value;
                fname= document.register.fname.value;
                phonen= document.register.phonen.value;
                bdate= document.register.bdate.value;
                today= new Date().toJSON().slice(0,10);
                if(lname == null || !(isNaN(lname)) ){
                        alert("El campo apellido sólo permite letras. Presione aceptar para volver a intentarlo.");
                        document.register.lname.focus();
                        return false;
                }else if(fname == null || !(isNaN(fname))) {
                        alert("El campo nombre sólo permite letras. Presione aceptar para volver a intentarlo.");
                        document.register.fname.focus();
                        return false;
                }else if(phonen == null || isNaN(phonen)){
                        alert("El campo teléfono sólo permite números. Presione aceptar para volver a intentarlo.");
                        document.register.phonen.focus();
                        return false;
                }else if(Date.parse(bdate) > Date.parse(today)){
                        alert("El campo fecha de nacimiento debe contener una fecha válida. Presione aceptar para volver a intentarlo.");
                        document.register.bdate.focus();
                        return false;
                }
                else{
                        return true;
                }
        break;
        
    }
}

//QUESTION BOX

function openQuestionBox(){
    setTimeout("openQuestionBox2()",200);
}
function openQuestionBox2(){
    document.question.questionBox.style.height="10%";
    document.question.questionButton.removeAttribute("style");
}

function closeQuestionBox(){
    setTimeout("closeQuestionBox2()",200);
}

function closeQuestionBox2(){
    document.question.questionBox.style.height="6%";
    document.question.questionButton.style.display="none";
}
// ANSWER BOX

function openAnswerBox(id){
    setTimeout("openAnswerBox2("+id+")",200);
}
function openAnswerBox2(id){
    $('#answerBox' + id).css('height', '10%');
    $('#answerButton' + id).show();
    show("answerButton" + id);
}

function closeAnswerBox(id){
    setTimeout("closeAnswerBox2("+id+")",200);
}

function closeAnswerBox2(id){
    $('#answerBox' + id).css('height', '6%');
    hide("answerButton" + id);
}

function showAnswerForm(id){
    show('questionForm' + id);
    hide('showAnswerForm' + id);
    show('hideAnswerForm' + id);
}

function hideAnswerForm(id){
    hide('questionForm' + id);
    show('showAnswerForm' + id);
    hide('hideAnswerForm' + id);
}

//--------------------------------------------------------------
function sendQuestion(){
    question= document.question.questionBox.value;
    if(question == null || question.length < 20){
        alert("Debe escribir una pregunta con 20 caracteres minimo y 150 como maximo. Pulse aceptar para volver a intentar.");
        document.question.questionBox.focus();
        return false;
    } else
        return true;
}
function sendAnswer(id){
    answer= textareaValue('answerBox'+id);
    if(answer == null || answer.length < 20){
        alert("Debe escribir una pregunta con 20 caracteres minimo y 150 como maximo. Pulse aceptar para volver a intentar.");
        focus('answerBox'+id);
        return false;
    } else
        return true;
}

function confirmCancel(){
    if(confirm("¿Estas seguro que deseas cancelar y volver?"))
        history.back();
}

function redirect(url){
    location.href=url;
}

function redirectAfter(url, seconds){
    seconds= seconds * 1000;
    setTimeout("redirect('url')", seconds);
}

function hideDivBlur(id){
    $(document).ready(function(){
        $('html').click(function() {
            $(id).css('display', 'none');
        });
    });
}

function setDefaultIMG(){
    $(document).ready(function(){        
        $('#img1').click(function() {
            imgurl= $('#img1').attr('src');
            $('#imgdefault').attr('src', imgurl);
            $('#imglink').attr('href', imgurl);
        });
        $('#img2').click(function() {
            imgurl= $('#img2').attr('src');
            $('#imgdefault').attr('src', imgurl);
            $('#imglink').attr('href', imgurl);
        });
        $('#img3').click(function() {
            imgurl= $('#img3').attr('src');
            $('#imgdefault').attr('src', imgurl);
            $('#imglink').attr('href', imgurl);
        });
        $('#img4').click(function() {
            imgurl= $('#img4').attr('src');
            $('#imgdefault').attr('src', imgurl);
            $('#imglink').attr('href', imgurl);
        });
        $('#img5').click(function() {
            imgurl= $('#img5').attr('src');
            $('#imgdefault').attr('src', imgurl);
            $('#imglink').attr('href', imgurl);
        });
    });
}

function confirmacion(){
    	return(confirm("Usted va a modificar de forma permanente los datos, proceder?"));
}

function confirmacionA(){
   	return(confirm("Esta seguro que quiere agregar este tipo de Hospedaje?"));
}

function passConfirm(){
    pass= document.register.pass.value;
    rpass= document.register.rpass.value;
    if(pass != rpass)
        document.register.pass.style.border="3px solid rgba(189, 8, 8, 0.61)";
    else
        document.register.pass.style.border="3px solid rgba(8, 165, 8, 0.63)";
}
function submitDesactivation(){
    $('input[type="submit"]').css('background-color', 'darkgray');
    $('input[type="submit"]').attr('disabled','disabled');  
}

function submitActivation(){
    $('input[type="submit"]').css('background-color', 'rgba(150, 172, 60, 0.92)');
    $('input[type="submit"]').removeAttr('disabled');  
}

function validatePasswords(){
        $('document').ready(function(){
                pass= $('#pass');
                rpass= $('#rpass');
                
                submitDesactivation();
                function passCoincidence(){
                        pass1= pass.val();
                        pass2= rpass.val();
                        if(pass1 != pass2){
                                pass.css('border', '3px solid rgba(189, 8, 8, 0.61)');
                                rpass.css('border', '3px solid rgba(189, 8, 8, 0.61)');
                                submitDesactivation();
                        }
                        if(pass1 == pass2){
                                pass.css('border', '3px solid rgba(8, 165, 8, 0.63)');
                                rpass.css('border', '3px solid rgba(8, 165, 8, 0.63)');
                                submitActivation();
                        }
                        if(pass1.length == 0 && pass2.length == 0){
                                pass.css('border', '');
                                rpass.css('border', '');
                                submitDesactivation();
                        }
                }
                pass.keyup(function(){
                        passCoincidence();
                });
                rpass.keyup(function(){
                        passCoincidence();
                });
        });
}

function validateInputFile(){
    $('document').ready(function(){
        img1= $('#img1');
        img2= $('#img2');
        img3= $('#img3');
        img4= $('#img4');
        img5= $('#img5');
        if(img2.val() == ""){
            img2.hide();
        }
        if(img3.val() == ""){
            img3.hide();
        }
        if(img4.val() == ""){
            img4.hide();
        }
        if(img5.val() == ""){
            img5.hide();
        }
        
        img1.change(function(){
            if (img1.val() == ''){
                hideAndClear('img2');
                hideAndClear('img3');
                hideAndClear('img4');
                hideAndClear('img5');
            }else
                show('img2');
        });
        
        img2.change(function(){
            if (img2.val() == ''){
                hideAndClear('img3');
                hideAndClear('img4');
                hideAndClear('img5');
            }else
                show('img3');
        });
        
        img3.change(function(){
            if (img3.val() == ''){
                hideAndClear('img4');
                hideAndClear('img5');
            }else
                show('img4');
        });
        
        img4.change(function(){
            if (img4.val() == ''){
                hideAndClear('img5');
            }else
                show('img5');
        });
    });
}