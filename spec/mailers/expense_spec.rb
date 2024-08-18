require 'rails_helper'

RSpec.describe ExpenseMailer, type: :mailer do
  let(:user) do
    User.create(
      name: Faker::Name.name,
      email: Faker::Internet.email,
      password: Faker::Alphanumeric.alphanumeric(number: 10)
    )
  end

  let(:expense) do
    Expense.new(
      category: :bill,
      name: Faker::Name.name,
      payment_date: Date.today + 30,
      value: Faker::Number.number(digits: 3),
      user_id: user.id
    )
  end

  describe 'payment_day_is_tomorrow' do
    let(:mail) do
      described_class.with(expense: expense).payment_day_is_tomorrow
    end

    it 'renders the headers' do
      expect(mail.subject).to eq "The payment day of #{expense.name} is tomorrow"
      expect(mail.to).to eq [expense.user.email]
      expect(mail.content_type).to eq 'text/html; charset=UTF-8'
    end

    it 'renders the body' do
      expect(mail.body.encoded).to include(expense.name)
    end
  end
end
