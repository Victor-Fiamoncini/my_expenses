class Expense < ApplicationRecord
  enum category: %i[
    bill
    food
    rent
    subscription
    transportation
    utilities
  ]

  belongs_to :user

  validates :category, presence: true
  validates :name, presence: true
  validates :value, numericality: { greater_than: 0 }, presence: true
end
