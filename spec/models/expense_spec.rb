require 'rails_helper'

RSpec.describe Expense, type: :model do
  before(:all) do
    @user = User.new(
      name: 'any_name',
      email: 'any_mail@mail.com',
      password: 'any_password'
    )

    puts 'USERRRR ', @user.id, @user.name

    @expense = Expense.new(
      name: 'any_name',
      value: 999,
      user_id: @user.id
    )
  end

  describe 'Associations' do
    it 'should belongs to user' do
      should respond_to(:user)
    end
  end

  describe 'Validations' do
    it 'is valid with valid attributes' do
      expect(@expense).to be_valid
    end

    # it 'is not valid without a name' do
    #   subject.name = nil
    #   expect(subject).to_not be_valid
    # end

    # it 'is not valid without a value' do
    #   subject.value = nil
    #   expect(subject).to_not be_valid
    # end

    # it 'is not valid without a zero or negative value' do
    #   subject.value = 0
    #   expect(subject).to_not be_valid

    #   subject.value = -999
    #   expect(subject).to_not be_valid
    # end
  end
end
