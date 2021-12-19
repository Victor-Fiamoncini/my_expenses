class SessionsController < ApplicationController
  # GET /
  def new
    @user = User.new
  end

  # POST /sessions
  def create
    @user = User.select(:id, :password).find_by(email: user_params[:email])

    if @user && @user.password == user_params[:password]
      session[:user_id] = @user.id

      redirect_to expenses_path
    else
      flash[:alert] = 'Invalid credentials.'

      redirect_to root_path
    end
  end

  # DELETE /sessions/1
  def destroy; end

  private

  def user_params
    params.require(:user).permit(:email, :password)
  end
end
