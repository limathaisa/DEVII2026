
async function fazRequisicaoAA(uri, metodo, dados =null){
    if(metodo==='GET')
        return await fetch(uri);
    return await fetch(uri, {
        method: metodo,
        headers: {"Content-Type" : "application/json; charset=UTF-8"},
        body: dados?JSON.stringify(dados):null
    })
}

function fazRequisicao(uri, metodo, dados =null){
    if(metodo==='GET')
        return fetch(uri);
    return fetch(uri, {
        method: metodo,
        headers: {"Content-Type" : "application/json; charset=UTF-8"},
        body: dados?JSON.stringify(dados):null
    })
}

async function verificaErros( resp ){
    let dados = null;
    try{
        dados = await resp.json();
    }catch{
        throw new Error( 'Problemas de conversão de JSON.' );
    }
    if( !resp.ok ){
        let msg = `URL: ${resp.url} - ${resp.status} - ${resp.statusText}`;
        if(dados?.erro) msg = dados.erro;
        throw new Error( msg );
    }
    if(!dados)
        throw new Error('Informações espradas do servidor ausentes.');
    return dados;
}

function exibeErro( elementoDOM, msg, tempo ){
    elementoDOM.textContent = msg;
    setTimeout(()=>elementoDOM.textContent="", tempo)
}

//função (limpaElementos) para limpar o textContent de elementos 
// a partir de uma classe ou conjunto de tags
function limpaElementos(rotulo){
    let displays = document.querySelectorAll(rotulo);
    for (const elemento of displays) {
        elemento.textContent = "";
    }
}

function limpaForm(elementoForm){
    elementoForm.reset();
}

export {fazRequisicao, fazRequisicaoAA, verificaErros, exibeErro, limpaElementos, limpaForm}