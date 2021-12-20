class SessionsController < ApplicationController
  before_action :set_user_by_email, only: %i[create]

  # GET / or /sessions/new
  def new
    @user = User.new
  end

  # POST /sessions
  def create
    respond_to do |format|
      if @user.present? && @user.authenticate(user_params[:password])
        session[:user_id] = @user.id

        format.html { redirect_to expenses_path }
      else
        flash[:alert] = 'Invalid credentials.'

        format.html { redirect_to root_path }
      end
    end
  end

  # DELETE /sessions/1
  def destroy; end

  private

  def set_user_by_email
    @user = User.select(:id, :password_digest).find_by(email: user_params[:email])
  end

  def user_params
    params.require(:user).permit(:name, :email, :password)
  end
end
