import { modalWindow } from './layouts.js';
import { categoryCreateForm } from './layouts.js';
import { transactionCreateForm } from './layouts.js';
import { transactionEditForm } from './layouts.js';
import { categoryComponent } from './layouts.js'
import { transaction } from './layouts.js';

class AuthAPI {
    async logout() {
        const response = await fetch('../api/api.php?action=log-out', {method: 'POST'});
        const result = await response.json();

        return result;
    }
}

class UserAPI {
    async getUsername() {
        const response = await fetch('../api/api.php?action=username');
        const username = await response.json();

        return username;
    }
}

class CategoryAPI {
    async getCategories() {
        const response = await fetch('../api/api.php?action=categories');
        const categories = await response.json();

        return categories;
    }

    async getCategoriesCount() {
        const response = await fetch('../api/api.php?action=categories-count');
        const count = await response.json();
        
        return count;
    }
}

class OperationAPI {
    async getTotalAmount(type) {
        const response = await fetch(`../api/api.php?action=total-amount&type=${type}`);
        const total_amount = await response.json();
        
        return total_amount;
    }

    async test_getTotalAmount(type, categoryId) {
        const response = await fetch(`../api/api.php?action=test-total-amount&type=${type}&category-id=${categoryId}`);
        const total_amount = await response.json();
        
        return total_amount;   
    }

    async getOperations() {
        const response = await fetch('../api/api.php?action=operations');
        const transactions = await response.json();
        
        return transactions;
    }

    async getOperationsByCategory(categoryId) {
        const response = await fetch(`../api/api.php?action=operation-by-category&category-id=${categoryId}`);
        const transactions = await response.json();

        return transactions;
    }

    async getOperation(id) {
        const response = await fetch(`../api/api.php?action=operation&id=${id}`);
        const transaction = await response.json();
        
        return transaction;
    }

    async getOperationsCount() {
        const response = await fetch('../api/api.php?action=operations-count');
        const count = await response.json();
        
        return count;
    }

    async postNewOperation(data) {
        const response = await fetch('../api/api.php?action=create-operation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();

        return result;
    }

    async deleteOperation(id) {
        const response = await fetch(`../api/api.php?action=operation-delete&id=${id}`);
        const transaction = await response.json();

        console.log(transaction);
        
        return transaction;
    }
}

const selectors = {
    app:                             document.querySelector('#app'),

    username:                        document.querySelector('.username'),
    logoutButton:                    document.querySelector('.navbar-button.exit'),

    totalAmountIncomes:              document.querySelector('.total-amount.ta-incomes'),
    totalAmountExpenses:             document.querySelector('.total-amount.ta-expenses'),

    categoriesCreateFormOpenButton:  document.querySelector('.create-new-category'),
    transactionCreateFormOpenButton: document.querySelector('.add-btn'),

    categoriesCount:                 document.querySelector('.categories-count'),
    transactionCount:                document.querySelector('.transactions-count'),

    categoriesContainer:             document.querySelector('.categories-row'), // //<i class="fa-solid fa-car"></i><i class="fa-solid fa-apple-whole"></i><i class="fa-solid fa-t-shirt"></i>
    operationsContainer:             document.querySelector('.operations'),
}

class Corrector {
    crusher(number) {
        number = number.toString();

        let result = '';
        let count = 0;

        for (let i = number.length - 1; i >= 0; i--) {
            result = number[i] + result;
            count++;

            if (count === 3 && i !== 0) {
                result = ' ' + result;
                count = 0;
            }
        }

        return result;
    }
}

class CategoryUI {
    async view(data) {
        const element = categoryComponent(data);
              element.addEventListener('click', async () => {
                // request api filtered list
              });
        
        selectors.categoriesContainer.prepend(element);
    }

    async viewAll(data) {
        for (let category of data) {
            this.view(category);
        }
    }
}

class OperationUI {
    async create(data) {
        const element = transaction(data);
              element.addEventListener('click', () => {
                  let editForm = transactionEditForm(data);
                      editForm.querySelector('.form-send-button-container').addEventListener('click', async () => {
                              await operationsAPI.deleteOperation(data.id);
                              element.remove();
                              modal.remove();
                          });

                  let modal = modalWindow();
                        modal.addEventListener('click', (e) => {
                            if (e.target === modal) {
                                modal.remove();
                            }
                        });
                        modal.querySelector('.modal-close').addEventListener('click', () => {
                            modal.remove();
                        });
                        modal.querySelector('.modal-content').appendChild(editForm);

                  selectors.app.prepend(modal);
              });

        selectors.operationsContainer.appendChild(element);
    }

    async createByCategoryId(id) {
        this.create(await operationsAPI.getOperationsByCategory(id));
    }

    async createAll(data) {
        for (let operation of data) {
            this.create(operation);
        }
    }
}

class ModalUI {
    content = '';
    create() {
        const modal = modalWindow();
              modal.addEventListener('click', (e) => {
                  if (e.target === modal) {
                      modal.remove();
                  }
              }); 
              modal.querySelector('.modal-close').addEventListener('click', () => {
                  modal.remove();
              });
              modal.querySelector('.modal-content').appendChild(this.content);

        return modal;
    }
}

// создал модалку: const modal = new ModalUI();
// задаёшь свойства: path (место размещения окна в DOM), content (содержимое окна)
// используешь методы модалки: open, close

class OperationCreateFormUI {
    async create(data) {
        const form = transactionCreateForm(data);
              form.addEventListener('submit', async function(e) {
                  e.preventDefault();
                  let formValues = {
                      'amount':      form.elements['amount'].value, 
                      'date':        form.elements['date'].value,
                      'type':        form.elements['type'].value,
                      'description': form.elements['description'].value,
                      'category_id': form.elements['category'].selectedOptions[0].dataset.categoryId
                  };
                  // let createTransaction = await operation.create(formValues);
                //   console.log(createTransaction);
                  selectors.operationsContainer.prepend(transaction(formValues));
              });

        const modalUI = new ModalUI();
              modalUI.content = form;

        selectors.transactionCreateFormOpenButton.addEventListener('click', () => {
            selectors.app.prepend(modalUI.create());
        });
    }
}

class App {
    async init() {
        const authAPI = new AuthAPI();
        const userAPI = new UserAPI();
        const categoriesAPI = new CategoryAPI();
        const operationsAPI = new OperationAPI();

        selectors.username.innerText = await userAPI.getUsername();

        selectors.logoutButton.addEventListener('click', async () => {
            if (await authAPI.logout().success) {
                window.location.href = '../signin.php';
            }
        });

        const corrector = new Corrector();
        selectors.totalAmountIncomes.innerText = corrector.crusher(await operationsAPI.getTotalAmount('income'));
        selectors.totalAmountExpenses.innerText = corrector.crusher(await operationsAPI.getTotalAmount('expense'));
        //   selectors.totalAmountIncomes.innerText = corrector.crusher(await operationsAPI.test_getTotalAmount('income', data.id));
        //   selectors.totalAmountExpenses.innerText = corrector.crusher(await operationsAPI.test_getTotalAmount('expense', data.id));

        selectors.categoriesCount.innerText = `Категории (${await categoriesAPI.getCategoriesCount()})`;
        selectors.transactionCount.innerText = `Транзакции (${await operationsAPI.getOperationsCount()})`;
        
        let operationCreateForm = new OperationCreateFormUI();
            operationCreateForm.create(await categoriesAPI.getCategories());

        let categoryUI = new CategoryUI(); 
            categoryUI.viewAll(await categoriesAPI.getCategories())

        let operationUI = new OperationUI();
            operationUI.createAll(await operationsAPI.getOperations());
    }
}

const app = new App();
app.init();