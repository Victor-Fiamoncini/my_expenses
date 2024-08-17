require 'rails_helper'

RSpec.describe Expense, type: :model do
  let(:user) do
    User.create(
      name: Faker::Name.name,
      email: Faker::Internet.email,
      password: Faker::Alphanumeric.alphanumeric(number: 10)
    )
  end

  subject do
    described_class.new(
      category: :bill,
      name: Faker::Name.name,
      payment_date: Date.today + 30,
      value: Faker::Number.number(digits: 3),
      user_id: user.id
    )
  end

  describe 'Associations' do
    it { should belong_to(:user) }

    it 'should belongs to user' do
      should respond_to(:user)
    end
  end

  describe 'Validations' do
    it 'is valid with valid attributes' do
      expect(subject).to be_valid
    end

    it 'is not valid without a name' do
      subject.name = nil
      expect(subject).to_not be_valid
    end

    it 'is not valid without a value' do
      subject.value = nil
      expect(subject).to_not be_valid
    end

    it 'is not valid without a zero or negative value' do
      subject.value = 0
      expect(subject).to_not be_valid

      subject.value = -999
      expect(subject).to_not be_valid
    end

    it 'is valid with a valid category' do
      subject.category = :food
      expect(subject).to be_valid
    end

    it 'is not valid without a category' do
      subject.category = nil
      expect(subject).not_to be_valid
    end

    it 'is not valid with an invalid category' do
      expect do
        subject.category = :invalid_category
        expect(subject).not_to be_valid
      end.to raise_error(ArgumentError)
    end

    it 'is valid with a valid payment_date' do
      subject.payment_date = Date.today + 30
      expect(subject).to be_valid
    end

    it 'is not valid without a payment_date' do
      subject.payment_date = nil
      expect(subject).not_to be_valid
    end

    it 'is not valid with a past payment_date' do
      subject.payment_date = Date.today - 30
      expect(subject).not_to be_valid
    end
  end
end
