Rails.application.routes.draw do
  get '/register', to: 'users#new'

  resources :users, only: [:create]
  resources :expenses, except: [:show]
end
