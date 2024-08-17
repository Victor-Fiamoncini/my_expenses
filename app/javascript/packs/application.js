import Rails from '@rails/ujs'
import Turbolinks from 'turbolinks'
import * as ActiveStorage from '@rails/activestorage'

import Cleave from 'cleave.js'
import flatpickr from 'flatpickr'

import 'bootstrap'
import 'channels'
import 'flatpickr/dist/flatpickr.min.css'
import 'flatpickr/dist/themes/material_green.css'

Rails.start()
Turbolinks.start()
ActiveStorage.start()

const convertFromMonetaryToNumeric = value => {
  if (!value) return null

  // Remove the "R$" prefix
  value = value.replace('R$', '').trim()
  // Remove the thousands separator (.)
  value = value.replace(/\./g, '')
  // Replace the comma with a period
  value = value.replace(',', '.')

  return parseFloat(value)
}

const convertFromNumericToMonetary = value => {
  if (!value) return null

  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  }).format(value)
}

document.addEventListener('turbolinks:load', () => {
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

  flatpickr('input[type=date]', {
    dateFormat: 'd/m/Y',
    altInput: true,
    altFormat: 'd/m/Y',
    allowInput: true,
    minDate: 'today',
  })
})
