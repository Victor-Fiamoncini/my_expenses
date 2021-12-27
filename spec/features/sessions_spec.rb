require 'rails_helper'

RSpec.describe 'Sessions', type: :system do
  before :all do
    @user = User.create(
      name: Faker::Name.name,
      email: Faker::Internet.email,
      password: Faker::Alphanumeric.alphanumeric(number: 10)
    )
  end

  describe 'Login page' do
    it 'should show the login page' do
      visit root_path
      expect(page).to have_content('Login')
    end

    it 'should login with correct credentials' do
      visit root_path
      within('#sessions-new') do
        fill_in 'user_email', with: @user.email
        fill_in 'user_password', with: @user.password
      end
      click_button 'Login'
      expect(page).to have_content('Home')
    end

    it 'should get error message with invalid credentials' do
      visit root_path
      within('#sessions-new') do
        fill_in 'user_email', with: 'invalid_email@mail.com'
        fill_in 'user_password', with: 'invalid_password'
      end
      click_button 'Login'
      expect(page).to have_content('Invalid credentials.')
    end
  end
end
