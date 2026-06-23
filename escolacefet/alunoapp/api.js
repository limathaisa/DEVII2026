import { fazRequisicaoAA, verificaErros } from "../js/util.js";
const url = '../../api/aluno/controller/';
export async function insere( aluno ) {
        let resposta =  await fazRequisicaoAA( url+'inserir.php' , 'POST', aluno ); 
        let dados = await verificaErros( resposta );
        if( ! dados )
            throw new Error(' Dados esperados ausentes.  ');
        return dados;
}

export async function lista( ) {
        let resposta =  await fazRequisicaoAA( url+'listar.php' ); 
        let dados = await verificaErros( resposta );
        if( ! dados )
            throw new Error(' Dados esperados ausentes.  ');
        return dados;
}
export async function remove(id) {
    let resposta= await fazRequisicaoAA(url+'remover.php?id='+id, 'DELETE');
    if (resposta.status===204)
        return;
    let dados = await verificaErros(resposta);
    if (!dados)
        throw new Error('Dados esperados ausentes.');
    return dados;
}

export async function obterPeloId(id) {
    let resposta=await fazRequisicaoAA(url+'obterPeloId.php?id='+id);
    let dados = await verificaErros(resposta);
    if (!dados)
        throw new Error('Dados esperados ausentes. ');
    return dados;
}

export async function altera(aluno) {
    let resposta= await fazRequisicaoAA(url+'alterar.php', 'PUT', aluno);
    let dados = await verificaErros(resposta);
    if(!dados)
        throw new Error ('Dados esperados. ');
    return dados;
}

export async function obterPeloNome(nome) {
    let resposta=await fazRequisicaoAA(url+'obterPeloNome.php?nome='+nome);
    let dados = await verificaErros(resposta);
    return dados;
    
}