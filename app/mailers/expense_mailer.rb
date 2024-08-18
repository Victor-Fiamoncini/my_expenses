class ExpenseMailer < ApplicationMailer
  def payment_day_is_tomorrow
    @expense = params[:expense]
    @user = @expense.user

    subject = "The payment day of #{@expense.name} is tomorrow"

    mail to: @user.email, subject: subject, content_type: 'text/html'
  end
end
