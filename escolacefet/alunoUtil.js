const formAluno = document.querySelector('form');
const spanErro = document.querySelector('#erro');

//Criar as funções valida, preencheDados
function preencheDados({nome, media, grau}){
    document.querySelector('#dados').textContent = "Dados do aluno";
    document.querySelector('#alunoNome').textContent = `Nome: ${nome}`;
    document.querySelector('#alunoMedia').textContent = `Média: ${media}`;
    document.querySelector('#alunoGrau').textContent = `Grau: ${grau}`;
}
function valida({nome, nota1, nota2}){
    if(!nome) return "Preencha o nome.";
    if( Number.isNaN(nota1) || Number.isNaN(nota2) )
        return "Notas precisam conter valores numéricos";
    /*if( nota1<0 || nota1>10 || nota2<0 || nota2>10 )
        return "As notas devem estar entre 0 e 10.";*/
    return null;
}

//CRIAR E EXPORTAR TABELA
function preencheTabela( alunos ){
    //define a costante pegando #tbAluno.
    const corpoTbl = document.querySelector('#tblAluno tbody');
    //esquanto existir um filho, remova ele.
    while(corpoTbl.firstChild)
        corpoTbl.removeChild(corpoTbl.firstChild);

    alunos.forEach(aluno => {
    const linha = document.createElement('tr');
    const {id, nome, media, nota1, nota2, grau} = aluno; // as informações do obj desconstruido vai ser igual ao objeto que estamos perorrendo.
    const [tdId, tdNome, tdNota1, tdNota2, tdMedia, tdGrau, tdAcoes]   = ['td','td','td','td','td','td','td',].map( tagId => document.createElement(tagId));
    tdId.textContent = id; 
    tdNome.textContent = nome; 
    tdMedia.textContent = media; 
    tdNota1.textContent = nota1; 
    tdNota2.textContent = nota2; 
    tdGrau.textContent = grau; 

    const [btnExcluir, btnAlterar] = ['button', 'button'].map(btn => document.createElement(btn));
    btnExcluir.dataset.id = id;
    btnExcluir.textContent = '[EXCLUIR]';
    btnAlterar.dataset.id = id;
    btnAlterar.textContent = '[ALTERAR]';
    tdAcoes.append(btnExcluir,btnAlterar);
    linha.append(tdId, tdNome, tdMedia, tdNota1, tdNota2, tdGrau, tdAcoes);
    corpoTbl.appendChild(linha);
    });
}
export { valida, preencheDados, spanErro, formAluno, preencheTabela }
