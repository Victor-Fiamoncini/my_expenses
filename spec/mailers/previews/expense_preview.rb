# Preview all emails at http://localhost:3000/rails/mailers/expense
class ExpensePreview < ActionMailer::Preview
  def payment_day_is_tomorrow
    expense = Expense.first

    ExpenseMailer.with(expense: expense).payment_day_is_tomorrow
  end
end
