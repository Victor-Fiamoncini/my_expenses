Rails.application.routes.draw do
  root 'sessions#new'

  resources :users, only: %i[new create]
  resources :sessions, only: %i[new create destroy]
  resources :expenses, except: %i[show]
end
