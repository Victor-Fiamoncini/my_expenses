import axios from 'axios'
import Cleave from 'cleave.js'
import flatpickr from 'flatpickr'
import IMask from 'imask'

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
    const expenseValueInput = document.getElementById('value')
    const phoneInput = document.getElementById('phone')

    if (expenseValueInput) {
        expenseValueInput.value = convertFromNumericToMonetary(expenseValueInput.value)

        new Cleave(expenseValueInput, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            noImmediatePrefix: true,
            rawValueTrimPrefix: true,
            numeralDecimalScale: 2,
        })

        const expenseForm = expenseValueInput.closest('form')

        if (expenseForm) {
            expenseForm.addEventListener('submit', () => {
                expenseValueInput.value = convertFromMonetaryToNumeric(expenseValueInput.value)
            })
        }
    }

    if (phoneInput) {
        const phoneMask = IMask(phoneInput, { mask: [{ mask: '(00) 0000-0000' }, { mask: '(00) 00000-0000' }] })

        const userForm = phoneInput.closest('form')

        if (userForm) {
            userForm.addEventListener('submit', () => {
                phoneInput.value = phoneMask.unmaskedValue
            })
        }
    }

    flatpickr('input[id=payment-date]', {
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'd/m/Y',
        allowInput: false,
        enableTime: false,
    })
})
