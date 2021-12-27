require 'rails_helper'

RSpec.describe 'Sessions', type: :system do
  before :all do
    @user = User.create(
      name: 'any_name',
      email: 'any_mail@mail.com',
      password: 'any_password'
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
        fill_in 'email', with: @user.email
        fill_in 'password', with: @user.password
      end
      click_button 'Login'
      expect(page).to have_content 'Logout'
    end
  end
end
