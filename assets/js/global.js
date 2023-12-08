  function positiveNumberFormat(element) {
        let inputValue = element.value;
        if (/[^0-9]/.test(inputValue) || inputValue.charAt(0) === '0') {
            let strippedValue = inputValue.replace(/[^0-9]/g, '');
            element.value = strippedValue;
        }
    };
