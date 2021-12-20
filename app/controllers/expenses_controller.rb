class ExpensesController < ApplicationController
  before_action :set_expense, only: %i[edit update destroy]

  # GET /expenses
  def index
    @expenses = Expense.all.paginate(page: params[:page], per_page: 5)
  end

  # GET /expenses/new
  def new
    @expense = Expense.new
  end

  # GET /expenses/1/edit
  def edit; end

  # POST /expenses
  def create
    @expense = Expense.new(expense_params)

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

  def set_expense
    @expense = Expense.find(params[:id])
  end

  def expense_params
    params.require(:expense).permit(:name, :value)
  end
end
