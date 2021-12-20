class Expense < ApplicationRecord
  belongs_to :user

  validates :name, presence: true
  validates :value, numericality: { greater_than: 0 }, presence: true
end
