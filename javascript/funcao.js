window.onload = function()
{
   // esconde();
   // document.querySelector("#pesquisar").onclick=function(){mostrar()}
   // document.querySelector("#menu").onmouseover=function(){mudar(this)}

}

function esconde()
{
    document.getElementById("tabela-notas").style.display='none';
}

function mostrar()
{
    document.getElementById("tabela-notas").style.display='block';
}

function sob(x)
{
    document.getElementById(x).style.color="white";
}

function tirar(x)
{
    document.getElementById(x).style.color="rgba(255,255,255,.5)";
}