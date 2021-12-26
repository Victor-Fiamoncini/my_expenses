require 'rails_helper'

RSpec.describe User, type: :model do
  subject do
    described_class.new(
      name: 'any_name',
      email: 'any_mail@mail.com',
      password: 'any_password'
    )
  end

  describe 'Associations' do
    it { should have_many(:expenses).without_validating_presence }

    it 'should have many expenses' do
      should respond_to(:expenses)
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

    it 'is not valid without an email' do
      subject.email = nil
      expect(subject).to_not be_valid
    end

    it 'is not valid without a valid email' do
      subject.email = 'invalid_mail'
      expect(subject).to_not be_valid
    end

    it 'is not valid without a password' do
      subject.password = nil
      expect(subject).to_not be_valid
    end

    it 'is not valid without a valid password' do
      subject.password = 'invalid'
      expect(subject).to_not be_valid
    end
  end
end
