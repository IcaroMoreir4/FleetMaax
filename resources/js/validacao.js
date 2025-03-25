document.addEventListener("DOMContentLoaded", function () {
    
    // Validação da page de login.
    
    // Função para validar CNPJ (simplificada)
    function validarCNPJ(cnpj) {
        return cnpj.length === 14;
    }

    // Simulação de CNPJs e e-mails já cadastrados (para testes)
    const cnpjsCadastrados = ["12345678000195", "98765432000112"];
    const emailsCadastrados = ["teste@email.com", "empresa@email.com"];

    // Validação do formulário de login
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();
            let isValid = true;

            const cnpj = document.getElementById("cnpj").value;
            const cnpjError = document.getElementById("cnpjError");

            // Verifica se o CNPJ está cadastrado
            if (!cnpjsCadastrados.includes(cnpj)) {
                cnpjError.textContent = "CNPJ não cadastrado!";
                cnpjError.classList.remove("hidden");
                isValid = false;
            } else {
                cnpjError.classList.add("hidden");
            }

            const password = document.getElementById("password").value;
            const passwordError = document.getElementById("passwordError");

            // Simulação de senha incorreta (para testes)
            if (password !== "senha123") {
                passwordError.textContent = "Senha incorreta!";
                passwordError.classList.remove("hidden");
                isValid = false;
            } else {
                passwordError.classList.add("hidden");
            }

            if (isValid) {
                alert("Login realizado com sucesso!");
                loginForm.submit(); // Submete o formulário ao backend
            }
        });
    }

    // Validação do formulário de registro
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            event.preventDefault();
            let isValid = true;

            const cnpj = document.getElementById("cnpj").value;
            const cnpjError = document.getElementById("cnpjError");

            if (!validarCNPJ(cnpj)) {
                cnpjError.textContent = "CNPJ inválido!";
                cnpjError.classList.remove("hidden");
                isValid = false;
            } else if (cnpjsCadastrados.includes(cnpj)) {
                cnpjError.textContent = "CNPJ já cadastrado!";
                cnpjError.classList.remove("hidden");
                isValid = false;
            } else {
                cnpjError.classList.add("hidden");
            }

            const email = document.getElementById("email").value;
            const emailError = document.getElementById("emailError");
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                emailError.textContent = "E-mail inválido!";
                emailError.classList.remove("hidden");
                isValid = false;
            } else if (emailsCadastrados.includes(email)) {
                emailError.textContent = "E-mail já cadastrado!";
                emailError.classList.remove("hidden");
                isValid = false;
            } else {
                emailError.classList.add("hidden");
            }

            const password = document.getElementById("password").value;
            const passwordError = document.getElementById("passwordError");

            if (password.length < 6) {
                passwordError.textContent = "A senha deve ter pelo menos 6 caracteres!";
                passwordError.classList.remove("hidden");
                isValid = false;
            } else {
                passwordError.classList.add("hidden");
            }

            const confirmPassword = document.getElementById("confirmPassword").value;
            const confirmPasswordError = document.getElementById("confirmPasswordError");

            if (confirmPassword !== password) {
                confirmPasswordError.textContent = "As senhas não coincidem!";
                confirmPasswordError.classList.remove("hidden");
                isValid = false;
            } else {
                confirmPasswordError.classList.add("hidden");
            }

            if (isValid) {
                alert("Registro realizado com sucesso!");
                registerForm.submit(); // Submete o formulário ao backend
            }
        });
    }

    // Validação da page de registro.

    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita o envio do formulário antes da validação
    
        let isValid = true;
        
        // Validação do CNPJ (simples, só verifica se foi preenchido)
        const cnpj = document.getElementById('cnpj').value.trim();
        if (cnpj.length !== 18) {
            document.getElementById('cnpjError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('cnpjError').classList.add('hidden');
        }
    
        // Validação da Razão Social
        const razaoSocial = document.getElementById('razaoSocial').value.trim();
        if (razaoSocial === '') {
            document.getElementById('razaoError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('razaoError').classList.add('hidden');
        }
    
        // Validação do Email
        const email = document.getElementById('email').value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('emailError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('emailError').classList.add('hidden');
        }
    
        // Validação da Senha
        const password = document.getElementById('password').value.trim();
        if (password.length < 6) {
            document.getElementById('passwordError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('passwordError').classList.add('hidden');
        }
    
        // Validação da Confirmação de Senha
        const confirmPassword = document.getElementById('confirmPassword').value.trim();
        if (confirmPassword !== password) {
            document.getElementById('confirmPasswordError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('confirmPasswordError').classList.add('hidden');
        }
    
        // Se todas as validações passaram, o formulário pode ser enviado
        if (isValid) {
            alert('Cadastro realizado com sucesso!');
            this.submit();
        }
    });

    // Função para alternar a exibição da senha
    document.querySelectorAll('.fa-eye, .fa-eye-slash').forEach(icon => {
        icon.addEventListener('click', function () {
            const input = this.previousElementSibling; // Pegando o input antes do ícone
            if (input.type === "password") {
                input.type = "text";
                this.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                this.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
    });

});
