function maxiLength (campo) {
    if (campo.value.length > campo.maxLength){
        campo.value = campo.value.slice(0, campo.maxLength)
    }
}
