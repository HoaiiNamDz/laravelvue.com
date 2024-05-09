export const handleFormError = (error, formErrorMessages) => {
    formErrorMessages.value = {}
    if (error.response.status == 422) {
        Object.keys(error.response.data.errors).forEach(key => {
            formErrorMessages.value[key] = error.response.data.errors[key][0]
        })
    } else {
        formErrorMessages.value.message = error.response.data.message
    }
}
