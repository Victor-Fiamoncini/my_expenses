class UsersController < ApplicationController
  before_action :set_user, only: %i[create]

  # GET /users/new
  def new
    @user = User.new
  end

  # POST /users
  def create
    respond_to do |format|
      if @user.valid?
        @user.save
        session[:user_id] = @user.id
        flash[:notice] = 'User was successfully created.'

        format.html { redirect_to expenses_path }
      else
        format.html { render action: :new }
      end
    end
  end

  private

  def set_user
    @user = User.new(user_params)
  end

  def user_params
    params.require(:user).permit(:name, :email, :password)
  end
end
