class ExpensesController < ApplicationController
  before_action :authorized
  before_action :set_expense_by_id, only: %i[edit update destroy]

  # GET /expenses
  def index
    @total_spent = current_user.expenses.sum(:value)
    @average = (@total_spent / current_user.expenses.count).round(2)
    @expenses = current_user.expenses.paginate(page: params[:page], per_page: 5)
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
        flash[:notice] = 'Expense was successfully created.'

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
        flash[:notice] = 'Expense was successfully updated.'

        format.html { redirect_to action: :edit }
      else
        format.html { render :edit, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /expenses/1
  def destroy
    @expense.destroy

    respond_to do |format|
      flash[:notice] = 'Expense was successfully destroyed.'

      format.html { redirect_to expenses_url }
    end
  end

  private

    def set_expense_by_id
      @expense = Expense.find(params[:id])
    end

    def expense_params_with_user
      expense_params.merge!(user_id: current_user.id)
    end

    def expense_params
      params.require(:expense).permit(:category, :name, :value)
    end
end
