# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the bin/rails db:seed command (or created alongside the database with db:setup).
#
# Examples:
#
#   movies = Movie.create([{ name: 'Star Wars' }, { name: 'Lord of the Rings' }])
#   Character.create(name: 'Luke', movie: movies.first)

user = User.create!(
  name: 'John Doe',
  email: 'john.doe@example.com',
  password: 'password'
)

15.times do |i|
  user.expenses.create!(name: "Expense ##{i + 1}", value: Random.rand(10...300))
end
