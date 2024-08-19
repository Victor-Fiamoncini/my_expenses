module ApplicationHelper
  def format_date_to_day_month_and_year(date)
    date.strftime '%d/%m/%Y'
  end

  def format_number_to_currency(number)
    number_to_currency number, unit: 'R$ ', separator: ',', delimiter: '.'
  end

  def is_past_date?(date)
    date < Date.today
  end
end
