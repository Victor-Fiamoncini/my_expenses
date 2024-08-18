class ExpenseMailer < ApplicationMailer
  def payment_day_is_tomorrow
    @expense = params[:expense]

    subject = "The payment day of your expense: #{@expense.name} is tomorrow"

    mail to: @expense.user.email, subject: subject, content_type: 'text/html'
  end
end
