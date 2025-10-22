/**
 * SINDPPENAL - Sistema de Permutação
 * Formulário Principal - JavaScript
 */

// Função para remover acentos (normalização)
function removerAcentos(str) {
    if (!str) return '';
    const acentos = {
        'á': 'a', 'à': 'a', 'ã': 'a', 'â': 'a', 'ä': 'a',
        'é': 'e', 'è': 'e', 'ê': 'e', 'ë': 'e',
        'í': 'i', 'ì': 'i', 'î': 'i', 'ï': 'i',
        'ó': 'o', 'ò': 'o', 'õ': 'o', 'ô': 'o', 'ö': 'o',
        'ú': 'u', 'ù': 'u', 'û': 'u', 'ü': 'u',
        'ç': 'c', 'ñ': 'n',
        'Á': 'A', 'À': 'A', 'Ã': 'A', 'Â': 'A', 'Ä': 'A',
        'É': 'E', 'È': 'E', 'Ê': 'E', 'Ë': 'E',
        'Í': 'I', 'Ì': 'I', 'Î': 'I', 'Ï': 'I',
        'Ó': 'O', 'Ò': 'O', 'Õ': 'O', 'Ô': 'O', 'Ö': 'O',
        'Ú': 'U', 'Ù': 'U', 'Û': 'U', 'Ü': 'U',
        'Ç': 'C', 'Ñ': 'N'
    };
    
    return str.split('').map(char => acentos[char] || char).join('');
}

$(document).ready(function() {
    // Verificar dependências
    if (typeof jQuery === 'undefined') {
        console.error('jQuery não encontrado');
        return;
    }
    
    if (typeof $.fn.select2 === 'undefined') {
        console.error('Select2 não encontrado');
        return;
    }
    
    // Verificar se os elementos existem
    if ($('#origem').length === 0) {
        console.error('Elemento #origem não encontrado');
        return;
    }
    
    if ($('#destino').length === 0) {
        console.error('Elemento #destino não encontrado');
        return;
    }
    
    // Configurar Select2 para origem (seleção única)
    $('#origem').select2({
        placeholder: "Selecione sua unidade atual",
        allowClear: true,
        width: '100%',
        minimumInputLength: 0,
        ajax: {
            url: './api/api_unidades.php',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: function (params) {
                // Normalizar termo de busca para ignorar acentos
                const termNormalizado = params.term ? removerAcentos(params.term.toLowerCase()) : '';
                return {
                    q: termNormalizado,
                    page: params.page || 1
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        language: {
            noResults: function() {
                return "Nenhuma unidade encontrada";
            },
            searching: function() {
                return "Buscando...";
            }
        }
    });

    $('#destino').select2({
        placeholder: "Selecione os destinos desejados",
        allowClear: true,
        width: '100%',
        minimumInputLength: 0,
        maximumSelectionLength: 3,
        ajax: {
            url: './api/api_unidades.php',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: function (params) {
                // Normalizar termo de busca para ignorar acentos
                const termNormalizado = params.term ? removerAcentos(params.term.toLowerCase()) : '';
                return {
                    q: termNormalizado,
                    page: params.page || 1
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        language: {
            noResults: function() {
                return "Nenhuma unidade encontrada";
            },
            searching: function() {
                return "Buscando...";
            },
            maximumSelected: function() {
                return "Você pode selecionar no máximo 3 destinos";
            }
        }
    });

    // Máscara para telefone - máximo 11 dígitos
    $('#telefone').on('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove tudo que não é dígito
        
        // Limita a 11 dígitos
        if (value.length > 11) {
            value = value.substring(0, 11);
        }
        
        // Aplica a máscara baseado na quantidade de dígitos
        if (value.length <= 10) {
            // Telefone fixo: (11) 1234-5678
            value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        } else {
            // Celular: (11) 91234-5678
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
        
        this.value = value;
    });

    // Validação adicional no blur para garantir formato correto
    $('#telefone').on('blur', function() {
        const value = this.value.replace(/\D/g, '');
        if (value.length < 10) {
            this.setCustomValidity('Telefone deve ter pelo menos 10 dígitos');
        } else {
            this.setCustomValidity('');
        }
    });

    // Auto-hide mensagens após 5 segundos
    setTimeout(function() {
        $('.mensagem').fadeOut(800);
    }, 5000);

    // Processamento do formulário para múltiplas seleções
    $('#formPermuta').on('submit', function(e) {
        console.log('Formulário sendo enviado...');
        
        // Verificar se o formulário é válido primeiro
        if (!this.checkValidity()) {
            console.log('Formulário inválido, não mostrando alert');
            return true; // Deixa a validação nativa do browser funcionar
        }
        
        console.log('Formulário válido, mostrando alert');
        
        // Se chegou aqui, o formulário é válido
        // Converter múltiplas seleções em string para o PHP
        const destinoSelect = $('#destino');
        const destinoValues = destinoSelect.val();
        
        if (destinoValues && destinoValues.length > 0) {
            // Criar input hidden com valores concatenados
            const destinoHidden = $('<input>').attr({
                type: 'hidden',
                name: 'destino',
                value: destinoValues.join(', ')
            });
            
            // Remover name do select para não enviar array
            destinoSelect.removeAttr('name');
            
            // Adicionar input hidden ao form
            $(this).append(destinoHidden);
        }
        
        // Exibir alert de sucesso
        alert('Formulário enviado com sucesso! 🎉');
        
        return true;
    });
});
