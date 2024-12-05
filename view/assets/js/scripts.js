function mascara(quantidade) {
    var valor = quantidade.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    var formatado = '';

    if (valor.length > 0) {
        formatado += '' + valor.substring(0, 2) + '';
    }

    if (valor.length > 2) {
        formatado += '' + valor.substring(2, 7);
    }

    quantidade.value = formatado;
}


function mascaraValorReal(a, e, r, t) {
    let n = "",
       h = j = 0,
       u = tamanho2 = 0,
       l = ajd2 = "",
       o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
       return !0;
    if (n = String.fromCharCode(o),
       -1 == "0123456789".indexOf(n))
       return !1;
    for (u = a.value.length,
       h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++);
    for (l = ""; h < u; h++) - 1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n, 0 == (u = l.length) && (a.value = ""), 1 == u && (a.value = "0" + r + "0" + l), 2 == u && (a.value = "0" + r + l), u > 2) {
       for (ajd2 = "",
          j = 0,
          h = u - 3; h >= 0; h--)
          3 == j && (ajd2 += e,
             j = 0),
          ajd2 += l.charAt(h),
          j++;
       for (a.value = "",
          tamanho2 = ajd2.length,
          h = tamanho2 - 1; h >= 0; h--)
          a.value += ajd2.charAt(h);
       a.value += r + l.substr(u - 2, u)
    }
    return !1
 }

function messageSuccess (event) {

    const btn = document.querySelector('#enviarBtn');




    document.getElementById('enviarBtn').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário
    
        // var inputValue = document.getElementById('myInput').value;
        // console.log('Input value:', inputValue);
    
        // Exibe a mensagem de sucesso
        var successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'block';
        successMessage.style.opacity = '1';
        console.log('passou aqui');
    
        // Oculta a mensagem de sucesso após 3 segundos
        setTimeout(function() {
            successMessage.style.opacity = '0';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 1000); // Aguarda a transição de fade-out
        }, 3000); // Mensagem visível por 3 segundos
    });

}
