import axios from 'axios'
import Cleave from 'cleave.js'
import flatpickr from 'flatpickr'

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const convertFromMonetaryToNumeric = value => {
    if (!value) return null

    // Remove the "R$" prefix & Remove the thousands separator (.) & Replace the comma with a period
    const cleanedValue = value.replace('R$', '').trim().replace(/\./g, '').replace(',', '.')

    return parseFloat(cleanedValue)
}

const convertFromNumericToMonetary = value => {
    if (!value) return null

    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    }).format(value)
}

document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('expense-value-input')

    if (!input) return

    const form = input.closest('form')

    if (input && form) {
        input.value = convertFromNumericToMonetary(input.value)

        new Cleave(input, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            noImmediatePrefix: true,
            rawValueTrimPrefix: true,
            numeralDecimalScale: 2,
        })

        form.addEventListener('submit', () => {
            input.value = convertFromMonetaryToNumeric(input.value)
        })
    }

    flatpickr('input[id=expense-payment-date-input]', {
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'd/m/Y',
        allowInput: false,
        enableTime: false,
    })
})
