class ExpensesController < ApplicationController
  EXPENSES_PER_PAGE = 10

  before_action :authorized
  before_action :set_expense_by_id, only: %i[edit update destroy]

  # GET /expenses
  def index
    expenses = current_user.expenses

    @total_spent = expenses.sum :value
    @average = (@total_spent / expenses.count).round 2
    @expenses = expenses.paginate(
      page: params[:page],
      per_page: EXPENSES_PER_PAGE
    )
  end

  # GET /expenses/new
  def new
    @expense = Expense.new
  end

  # GET /expenses/1/edit
  def edit; end

  # POST /expenses
  def create
    @expense = Expense.new(expense_params_with_user)

    respond_to do |format|
      if @expense.save
        flash[:notice] = "Expense #{@expense.name} was successfully registered"

        format.html { redirect_to expenses_url }
      else
        format.html { render :new, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /expenses/1
  def update
    respond_to do |format|
      if @expense.update(expense_params)
        flash[:notice] = "Expense #{@expense.name} was successfully updated"

        format.html { redirect_to expenses_url }
      else
        format.html { render :edit, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /expenses/1
  def destroy
    @expense.destroy

    respond_to do |format|
      flash[:notice] = "Expense #{@expense.name} was successfully deleted"

      format.html { redirect_to expenses_url }
    end
  end

  private

    def set_expense_by_id
      @expense = current_user.expenses.find(params[:id])
    end

    def expense_params_with_user
      expense_params.merge!(user_id: current_user.id)
    end

    def expense_params
      params.require(:expense).permit(:category, :name, :payment_date, :value)
    end
end
