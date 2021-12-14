class Expense < ApplicationRecord
  validates :name, presence: true
  validates :value, numericality: { greater_than: 0 }, presence: true
end
