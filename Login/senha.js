const inputs = document.querySelectorAll('.codigo-input');

  inputs.forEach((input, index) => {
    input.addEventListener('input', () => {
      // Garante que apenas um caractere seja inserido
      if (input.value.length > 1) {
        input.value = input.value.slice(0, 1);
      }

      // Move para o próximo input se um dígito for inserido
      if (input.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
    });

    input.addEventListener('keydown', (e) => {
      // Move para o input anterior ao pressionar Backspace em um campo vazio
      if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
        inputs[index - 1].focus();
      }
    });

    input.addEventListener('paste', (e) => {
      e.preventDefault();
      const pasteData = e.clipboardData.getData('text');
      const digits = pasteData.replace(/\D/g, '').split(''); // Remove não-dígitos

      digits.forEach((digit, i) => {
        if (i < inputs.length) {
          inputs[i].value = digit;
          if (i < inputs.length - 1) {
            inputs[i + 1].focus();
          }
        }
      });
    });
  });