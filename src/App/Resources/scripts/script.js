
setInterval(notificacoes, 500);

function notificacoes(){

    fetch("/contagem_avisos")
    .then(response => response.json())
    .then(data =>  mostrar(data))

    function mostrar(data){
        document.getElementById("badge").textContent = data["qtd"];
        console.log("shdhskhdkjaksd");
    }

}