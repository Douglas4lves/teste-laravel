
    //apaga a mensagem de erro após um tempo
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(el => el.remove());
    }, 3000); // Remove o HTML após 3 segundos
