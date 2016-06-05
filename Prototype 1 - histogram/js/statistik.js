$("#gennemsnit").click(function(){
    if($("#gennemsnit").prop('checked')){
        document.getElementById("averageLine").style.display="inline";
    }
    else{
        document.getElementById("averageLine").style.display="none";
    }
});