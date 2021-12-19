class UsersController < ApplicationController
  # GET /register
  def new
    @user = User.new
  end

  # POST /register
  def create
    @user = User.new(user_params)

    if @user.save
      flash[:notice] = 'User was successfully created.'

      redirect_to expenses_path
    else
      render :new, status: :unprocessable_entity
    end
  end

  private

  def user_params
    params.require(:user).permit(:name, :email, :password)
  end
end
