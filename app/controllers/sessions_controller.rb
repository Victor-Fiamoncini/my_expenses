class SessionsController < ApplicationController
  # GET /login
  def new
    @user = User.new
  end

  # POST /sessions/new
  def create; end

  # GET /logout
  def destroy; end
end
