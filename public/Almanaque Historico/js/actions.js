function criar_dica(id, link_img, titulo, texto){
    var myElement = document.querySelectorAll(".dica");
    if(myElement.length == 0){
        var div = document.createElement('div');
        
        div.innerHTML = '<img src="' + link_img +  '">' + '<h2>' + titulo + '</h2>' + '<p>' + texto + '</p>';
        div.className = 'dica';
        document.body.appendChild(div);

        var elemento = document.getElementById(id).getBoundingClientRect();

        if((elemento.x + div.getBoundingClientRect().right) > window.innerWidth){ 
            div.style.marginLeft = ((elemento.x + elemento.width + 40) - div.getBoundingClientRect().right - 5)  + "px";
        }
        else {
            div.style.marginLeft = (elemento.x + 40) + "px";
        }

        if((elemento.y + div.getBoundingClientRect().bottom) > window.innerHeight){ 
            div.style.marginTop = ((elemento.y + elemento.height) - div.getBoundingClientRect().bottom - 5)  + "px";
        }
        else {
            div.style.marginTop = elemento.y  + "px";
        }

    }
}

function apagar_dica(){
    var myElement = document.querySelectorAll(".dica");
    myElement.forEach(function(item){
        item.remove();
    });
}