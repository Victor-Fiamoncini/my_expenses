module ExpensesHelper
  def category_options
    [
      ['Bill', :bill],
      ['Food', :food],
      ['Rent', :rent],
      ['Subscription', :subscription],
      ['Transportation', :transportation],
      ['Utilities', :utilities]
    ]
  end

  def payment_date_to_view(payment_date)
    payment_date.strftime '%d/%m/%Y'
  end

  def number_to_currency_br(number)
    number_to_currency number, unit: 'R$ ', separator: ',', delimiter: '.'
  end
end
