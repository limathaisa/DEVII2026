

import { limpaElementos, exibeErro, limpaForm } from "../js/util.js";
import { spanErro, formAluno, preencheDados, valida, preencheTabela, preencheForm} from "./alunoUtil.js";
import { insere, lista, obterPeloId, remove, altera} from "./alunoApi.js";

document.addEventListener('DOMContentLoaded', async ()=>{
document.querySelector('#btnEnviar').value = "Calcular e inserir";

//Requisição para listar
try{
        let alunos = await lista();
        console.log(alunos);
        preencheTabela( alunos );
     } catch (erro) {
        exibeErro(spanErro, erro.message, 3000);
    }     
})
const tblAlunos = document.querySelector("#tblAluno tbody");
tblAlunos.addEventListener('click', async e => {
    const alvoClique = e.target // elemento que recebeu o click
    const elementoDOM = alvoClique;
    if(elementoDOM.tagName === 'BUTTON'){
        const botao = elementoDOM;
        if(botao.textContent === '[EXCLUIR]'){
            if(confirm('Deseja realmente remover o registro de id'+botao.dataset.id+'?')){
                try{
                    await remove(botao.dataset.id);
                    let alunos = await lista();
                    preencheTabela( tblAlunos );
                } catch(erro) {
                    exibeErro(spanErro, erro.message, 3000);
                } 
            }
        } else if(botao.textContent === '[ALTERAR]'){
            
                try{
                     let aluno = await obterPeloId(botao.dataset.id);
                    preencheForm( aluno );
               }catch (erro) {
                  exibeErro(spanErro, erro.message, 3000);
               }   

        }
    }
});

formAluno.addEventListener('submit', async e => {
    e.preventDefault();
    limpaElementos('.info');
    //montar um objeto aluno a partir dos inputs
    let aluno = {
        nome: document.querySelector('#nome').value.trim(),
        nota1: Number(document.querySelector('#nota1').value),
        nota2: Number(document.querySelector('#nota2').value)
    }
    //Tratamento de erros
    let msgErro = valida( aluno );
    if(msgErro){
        exibeErro( spanErro, msgErro, 3000);
        return; //Interrompe
    }
    //Requisição para inserir OU ALTERAR
    aluno.id = (document.querySelector('#id').value)?document.querySelector('#id').value:0;
    try{
        
        let dados = null;
        if(aluno.id <= 0)
           dados = await insere(aluno);    
        else{
            dados = await altera(aluno);
            document.querySelector("#btnEnviar").value = "calcula e insere";     
        }
      
        preencheDados( dados );
        limpaForm(formAluno);
        formAluno.id.value = 0;
       setTimeout(()=>{
        limpaElementos('.info');
       }, 3000);
       let alunos = await lista();
       preencheTabela( alunos );
     } catch (erro) {
        exibeErro(spanErro, erro.message, 3000);
    } 
})

//Fim do addEventListener
