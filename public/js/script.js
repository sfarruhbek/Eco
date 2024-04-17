let phone="";
let inputText=document.getElementById('phone');

function writeNumber(number){
    if (phone.length < 9) {
        phone += number;

        let text = "+998 (";
        if (phone.length >= 1) {
            text += phone[0];
        } else {
            text += "_";
        }
        if (phone.length >= 2) {
            text += phone[1];
        } else {
            text += "_";
        }
        text += ") "
        if (phone.length >= 3) {
            text += phone[2];
        } else {
            text += "_";
        }
        if (phone.length >= 4) {
            text += phone[3];
        } else {
            text += "_";
        }
        if (phone.length >= 5) {
            text += phone[4];
        } else {
            text += "_";
        }
        text += " "
        if (phone.length >= 6) {
            text += phone[5];
        } else {
            text += "_";
        }
        if (phone.length >= 7) {
            text += phone[6];
        } else {
            text += "_";
        }
        text += " "
        if (phone.length >= 8) {
            text += phone[7];
        } else {
            text += "_";
        }
        if (phone.length >= 9) {
            text += phone[8];
        } else {
            text += "_";
        }

        inputText.innerHTML = text;
    }
}

function backNumber(){
    phone=phone.slice(0,-1);

    let text="+998 (";
    if (phone.length>=1){ text+=phone[0]; }else{ text+="_";}
    if (phone.length>=2){ text+=phone[1]; }else{ text+="_";}
    text+=") "
    if (phone.length>=3){ text+=phone[2]; }else{ text+="_";}
    if (phone.length>=4){ text+=phone[3]; }else{ text+="_";}
    if (phone.length>=5){ text+=phone[4]; }else{ text+="_";}
    text+=" "
    if (phone.length>=6){ text+=phone[5]; }else{ text+="_";}
    if (phone.length>=7){ text+=phone[6]; }else{ text+="_";}
    text+=" "
    if (phone.length>=8){ text+=phone[7]; }else{ text+="_";}
    if (phone.length>=9){ text+=phone[8]; }else{ text+="_";}

    inputText.innerHTML=text;
}

function clearNumber(){
    phone="";
    let text="+998 (__) ___ __ __";
    inputText.innerHTML = text;
}