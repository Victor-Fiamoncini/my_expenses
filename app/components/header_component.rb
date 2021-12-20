class HeaderComponent < ViewComponent::Base
  def initialize(page_title:, logged_in: nil, user: nil)
    super

    @page_title = page_title
    @logged_in = logged_in
    @user = user
  end
end
