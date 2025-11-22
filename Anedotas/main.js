let perguntas = [];
let perguntaAtual = null;

fetch("perguntas.txt")
  .then((response) => response.text())
  .then((data) => {
    perguntas = data
      .split("\n")
      .filter((linha) => linha.trim() !== "")
      .map((linha) => {
        const [pergunta, resposta] = linha.split("|");
        return { pergunta: pergunta.trim(), resposta: resposta.trim() };
      });
    novaPergunta();
  })
  .catch((error) => console.error("Erro ao carregar o arquivo:", error));

function novaPergunta() {
  if (perguntas.length > 0) {
    const indice = Math.floor(Math.random() * perguntas.length);
    perguntaAtual = perguntas[indice];
    document.getElementById("pergunta").textContent = perguntaAtual.pergunta;
    document.getElementById("resposta").value = "";
    document.getElementById("resultado").textContent = "";
  }
}

function verificarResposta() {
  const respostaUsuario = document.getElementById("resposta").value.trim();
  const respostaCorreta = perguntaAtual.resposta.toLowerCase();
  document.getElementById("resultado").textContent = perguntaAtual.resposta;
}
