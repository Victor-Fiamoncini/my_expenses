require_relative 'boot'

require 'rails/all'

Bundler.require(*Rails.groups)

module MyExpenses
  class Application < Rails::Application
    config.load_defaults 6.1
    config.generators do |g|
      g.test_framework = :rspec
    end
  end
end
