
/**
 * Método para controlar visibilidade do container de edição de dados do cliente
 * 
 * @param { array } params Parâmetros do usuário
 * @return {void}
 */
function show_edit_container( params = [], action_url = null ){

    const cEdit = document.getElementById( 'c-edit-user' );

    if( !cEdit || cEdit == undefined ){

        alert( "Ocorreu um erro ao tentar abrir o menu de edição. Por favor, recarregue a página e tente novamente" );
        return;
    }
    
    if( action_url == null ){

        cEdit.style.display = 'none';
        return;
    }

    const fields = clear_fields(  );

    fill_edit_container( params, fields );

    set_action_form( action_url );

    cEdit.style.display = cEdit.style.display == 'block' ? 'none' : 'block';
}

/**
 * Função para limpar campos do formulário
 * 
 * @returns {array}
 */
function clear_fields(  ){

    const iId = document.querySelector( '#c-form-edit #i-disabled-id' );
    const iNome = document.querySelector( '#c-form-edit #i-nomeuser' );
    const iEmail = document.querySelector( '#c-form-edit #i-email' );

    const iArr = [ iId, iNome, iEmail ];

    iArr.forEach( ( input, key ) => {
        input.value = '';
    })

    return iArr
}

/**
 * Função criada para preencher campos do formulário na ação de edição
 * 
 * @param {array} params 
 * @param {array} fields 
 * 
 * @returns {void}
 */
function fill_edit_container( params, fields ){

    fields.forEach( ( input, key ) => {

        if( input )
            input.value = params[ key ];
    } )
}

/**
 * Função para configurar o tipo de ação do formulário
 * 
 * @param {string} action_url 
 * 
 * @returns {void}
 */
function set_action_form( action_url ){

    const form = document.querySelector( '#c-form-edit form' );
    
    form.action = action_url
}