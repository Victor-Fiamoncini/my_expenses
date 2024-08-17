# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the bin/rails db:seed command (or created alongside the database with db:setup).
#
# Examples:
#
#   movies = Movie.create([{ name: 'Star Wars' }, { name: 'Lord of the Rings' }])
#   Character.create(name: 'Luke', movie: movies.first)

require 'date'

def random_future_datetime
  now = DateTime.now
  future_days = rand(1..365) # Randomly pick a number of days in the future (1 to 365)
  future_time = now + future_days
  future_time.change(
    hour: rand(0..23),
    min: rand(0..59),
    sec: rand(0..59)
  )
end

user = User.create!(
  name: 'John Doe',
  email: 'john.doe@example.com',
  password: 'password'
)

15.times do |i|
  user.expenses.create!(
    category: Expense.categories.keys.sample,
    name: "Expense ##{i + 1}",
    payment_date: random_future_datetime,
    value: Random.rand(10...300).to_f.round(2)
  )
end
