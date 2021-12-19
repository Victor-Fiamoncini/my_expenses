class HeaderComponent < ViewComponent::Base
  def initialize(page_title:, user: nil)
    super
    @page_title = page_title
    @user = user
  end
end
