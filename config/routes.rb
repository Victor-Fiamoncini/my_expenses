Rails.application.routes.draw do
  get 'signup', to: 'users#new'

  resources :expenses, except: [:show]
end
