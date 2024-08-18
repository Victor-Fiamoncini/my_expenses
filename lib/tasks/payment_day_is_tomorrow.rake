namespace :daily do
  desc 'Email to notify users that their expenses payment day will be tomorrow'

  task payment_day_is_tomorrow: :environment do
    expenses_due_tomorrow = Expense.where payment_date: Date.tomorrow

    expenses_due_tomorrow.each do |expense|
      ExpenseMailer.with(expense: expense).payment_day_is_tomorrow.deliver_now
    end
  end
end
