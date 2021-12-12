json.extract! expense, :id, :name, :value, :created_at, :updated_at
json.url expense_url(expense, format: :json)
