class ApplicationController < ActionController::Base
  helper_method :current_user

  def current_user
    return unless session[:user_id]

    User.select(:id, :name).find_by(id: session[:user_id])
  end
end
