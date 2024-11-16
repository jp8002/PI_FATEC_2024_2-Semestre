
setInterval(notificacoes, 500);

function notificacoes(){
    $.ajax({
        url:"controle.php",
        type:"POST",
        dataType: "json",
        data:{action:"contagem"},
        success:function(response){
            document.getElementById("badge").textContent = response["qtd"];
            console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }
    })
}