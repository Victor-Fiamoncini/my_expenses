FROM ruby:3.0.3

RUN apt-get update -qq && apt-get install -y nodejs npm postgresql-client
RUN npm install -g yarn

WORKDIR /my_expenses_app

COPY Gemfile /my_expenses_app/Gemfile
COPY Gemfile.lock /my_expenses_app/Gemfile.lock

RUN bundle install

COPY package.json /my_expenses_app/package.json
COPY yarn.lock /my_expenses_app/yarn.lock

COPY . /my_expenses_app

CMD bash -c "rm -f tmp/pids/server.pid && bin/setup && rails s -b 0.0.0.0"
