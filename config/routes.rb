Rails.application.routes.draw do
  root 'sessions#new'
  get '/logout', to: 'sessions#destroy'
  get '/register', to: 'users#new'

  resources :users, only: [:create]
  resources :sessions, only: %i[create destroy]
  resources :expenses, except: [:show]
end
