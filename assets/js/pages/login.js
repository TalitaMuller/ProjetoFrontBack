function alternarSenha() {
    const input = document.getElementById('senha');
    const icone = document.querySelector('.olho-senha');
    
    if (input.type === "password") {
        input.type = "text";
        icone.textContent = "🙈"; 
    } else {
        input.type = "password";
        icone.textContent = "👁️"; 
    }
}