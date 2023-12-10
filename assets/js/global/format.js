function positiveNumberFormat(element) {
    let inputValue = element.value;

    if (/[^0-9]/.test(inputValue) || inputValue.charAt(0) === '0') {
        let strippedValue = inputValue.replace(/[^0-9]/g, '');
        element.value = strippedValue;
    }
};

function gradeInputFormat(element) {
    let inputValue = element.value;

    let strippedValue = inputValue.replace(/[^0-9]/g, '');

    let numericValue = parseInt(strippedValue, 10);
    if (isNaN(numericValue) || numericValue < 0) {
        numericValue = "";
    } else if (numericValue > 100) {
        numericValue = 100;
    }

    element.value = numericValue;
}
