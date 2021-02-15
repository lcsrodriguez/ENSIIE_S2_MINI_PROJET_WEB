function showVal(newVal){
    document.getElementById("vote_value").innerHTML=newVal;
}

var form = document.getElementById("vote_form");
var firstname = document.getElementById("vote_firstname");
var lastname = document.getElementById("vote_lastname");
var vote = document.getElementById("vote");
var msg = document.getElementById("vote_form_msg");

function checkInputs(){
    var firstname_value = firstname.value.trim();
    var lastname_value = lastname.value.trim();
    var vote_value = vote.value;

    if (firstname_value === "" || lastname_value === ""){
        msg.innerHTML = "<b>ERREUR</b> : Vous devez rentrer votre nom et prénom pour pouvoir voter !";
        form.style.border = "2px solid red";
        return false;
    }
    return true;
}


function showHint(str, annee) {
    console.log(str);
    console.log(annee)

    var xhttp;
    if (str.length === 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
            highlight(str);
        }
    };
    if (annee === '-'){
        xhttp.open("GET", "gethint.php?q="+str, true);
        xhttp.send();
    }else{
        xhttp.open("GET", "gethint.php?q="+str+"&a="+annee, true);
        xhttp.send();
    }

}

function highlight(text) {
    var inputText = document.getElementsByClassName("list_li");
    for (i = 0; i < inputText.length; i++){

        var innerHTML = inputText[i].innerHTML;
        var index = innerHTML.toLowerCase().indexOf(text.toLowerCase());
        if (index >= 0) {
            innerHTML = innerHTML.substring(0,index) + "<span class='highlight'>" + innerHTML.substring(index,index+text.length) + "</span>" + innerHTML.substring(index + text.length);
            inputText[i].innerHTML = innerHTML;
        }
    }
}