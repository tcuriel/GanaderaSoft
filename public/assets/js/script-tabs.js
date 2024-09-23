var abas = document.getElementById("abas");
var conteudos = document.getElementById("conteudos");

/* Essa função retira a classe "selecionada" e esconde a DIV com o conteúdo visível */
function limparSelecao(){
  abas.getElementsByClassName("selecionada")[0].classList.remove("selecionada");
  conteudos.getElementsByClassName("visivel")[0].classList.remove("visivel");
}

/* Essa é executada quando alguma das abas é clicada */
abas.addEventListener("click", function(event){
  var abaClicada = event.target.id;
  var itemSelecionado = abaClicada.substring(abaClicada.lastIndexOf("_"));
  console.log('Click...');
  /* Chama função que tira a seleção do item atual */
  limparSelecao();

  /* Insere a classe "selecionada" na nova aba visível */
  event.target.parentElement.classList.add("selecionada");

  /* Insere a classe "visivel" para o conteúdo da aba selecionada */
  // Original
  //conteudos.querySelector("#conteudo"+ itemSelecionado).classList.add("visivel");
  // Modificado para manejar excepción (Tirzo Curiel)
  const elemento = conteudos.querySelector("#conteudo" + itemSelecionado);
  if (elemento) {
    elemento.classList.add("visivel");
  } else {
    console.log('Adentro papá...');
    document.getElementById('aba_1').classList.add('selecionada');
    document.getElementById('conteudo_1').classList.add('visivel');
  }
});