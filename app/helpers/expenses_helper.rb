module ExpensesHelper
  def category_options
    [
      ['Bill', :bill],
      ['Food', :food],
      ['Rent', :rent],
      ['Subscription', :subscription],
      ['Transportation', :transportation],
      ['Utilities', :utilities]
    ]
  end
end
