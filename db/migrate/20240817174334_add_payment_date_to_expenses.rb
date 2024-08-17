class AddPaymentDateToExpenses < ActiveRecord::Migration[6.1]
  def change
    add_column :expenses, :payment_date, :date, null: false
    change_column_null :expenses, :user_id, false
  end
end
