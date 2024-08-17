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

  validates :category, presence: true, inclusion: { in: categories.keys }
  validates :name, presence: true
  validates :payment_date, presence: true
  validates :user_id, presence: true
  validates :value, numericality: { greater_than: 0 }, presence: true

  validate :payment_date_cannot_be_in_the_past

  private

    def payment_date_cannot_be_in_the_past
      return unless payment_date.present? && payment_date < Date.today

      errors.add(:payment_date, "Payment date can't be in the past")
    end
end
