class AddPaymentDateToExpenses < ActiveRecord::Migration[6.1]
  def change
    add_column :expenses, :payment_date, :datetime, null: false, precision: 0
    change_column_null :expenses, :user_id, false
  end
end
