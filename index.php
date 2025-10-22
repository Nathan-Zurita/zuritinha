<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Permuta - SINDPPENAL</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Animate.css para animações -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/sindppenal-theme.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="sindppenal-bg" style="background-image: url('./assets/images/background-verde.png'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <!-- Header -->
                <div class="card sindppenal-card mb-4">
                    <div class="card-body text-center sindppenal-header">
                        <h1 class="h3 text-sindppenal mb-1">
                            <img src="./assets/icons/formulario/form.svg" alt="Sistema" class="svg-icon size-lg">
                            Sistema de Permutação
                        </h1>
                        <p class="text-muted mb-0">SINDPPENAL - Sindicato dos Policiais Penais e Servidores do Sistema Penitenciário do Estado do Espírito Santo</p>
                    </div>
                </div>
                
                <!-- Formulário -->
                <div class="card sindppenal-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0 text-white">
                            <!-- <img src="./assets/icons/formulario/combination.svg" alt="Formulário" class="svg-icon-white size-md"> -->
                            Formulário de Permutação
                        </h5>
                    </div>
                    <div class="card-body sindppenal-form">
                        
                        <form action="processar_formulario.php" method="POST" id="formPermuta" class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.2rem;"></i>
                                    <strong>Todos os campos são obrigatórios.</strong>
                                </div>
                                <div class="col-12">
                                    <label for="nome" class="form-label fw-semibold">
                                        <img src="./assets/icons/formulario/user.svg" alt="Nome" class="svg-icon size-sm">
                                        Nome Completo:
                                    </label>
                                    <input type="text" id="nome" name="nome" class="form-control" 
                                           required placeholder="Digite seu nome completo">
                                    <div class="invalid-feedback">
                                        Por favor, informe seu nome completo.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="num_funcional" class="form-label fw-semibold">
                                        <img src="./assets/icons/formulario/card.svg" alt="Número" class="svg-icon size-sm">
                                        Número Funcional:
                                    </label>
                                    <input type="text" id="num_funcional" name="num_funcional" class="form-control" 
                                           placeholder="Ex: 12345" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe seu número funcional.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="telefone" class="form-label fw-semibold">
                                        <img src="./assets/icons/formulario/phone.svg" alt="Telefone" class="svg-icon size-sm">
                                        Telefone:
                                    </label>
                                    <input type="tel" id="telefone" name="telefone" class="form-control" required
                                           placeholder="(11) 99999-9999" maxlength="15">
                                    <div class="invalid-feedback">
                                        Por favor, informe seu telefone.
                                    </div>
                                </div>
                            
                                <div class="col-12">
                                    <label for="origem" class="form-label fw-semibold">
                                        <img src="./assets/icons/formulario/location.svg" alt="Origem" class="svg-icon size-sm">
                                        Local de Origem:
                                    </label>
                                    <select id="origem" name="origem" class="form-select" required>
                                        <option value="">Selecione sua unidade atual</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, selecione sua unidade atual.
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <label for="destino" class="form-label fw-semibold">
                                        <img src="./assets/icons/formulario/location.svg" alt="Destino" class="svg-icon size-sm">
                                        Local(is) de Destino:</label>
                                    <select id="destino" name="destino[]" multiple="multiple" class="form-select" required>
                                    </select>
                                    <div class="form-text">
                                        <small class="text-muted">
                                           <strong>Você pode selecionar até 3 destinos</strong> 
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor, selecione pelo menos um destino.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary py-3 fw-semibold">
                                    <img src="./assets/icons/formulario/enviar.svg" alt="Enviar" class="svg-icon-white size-sm">
                                    Enviar Solicitação
                                </button>
                            </div>
                        </form>
                    </div>

                    

                </div>
                
    
            </div>
        </div>
    </div>

    
    <!-- JavaScript customizado -->
    <script src="./assets/javascript/public/formulario.js"></script>
</body>
</html>