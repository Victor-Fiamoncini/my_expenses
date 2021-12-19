class HeaderComponent < ViewComponent::Base
  def initialize(page_title:)
    super
    @page_title = page_title
  end
end
