class AddCategoryToExpenses < ActiveRecord::Migration[6.1]
  def change
    add_column :expenses, :category, :integer, default: 0
    change_column_null :expenses, :name, false
    change_column_null :expenses, :value, false
    change_column_null :users, :name, false
    change_column_null :users, :email, false
    change_column_null :users, :password_digest, false
  end
end
