function formatAmount(type, amount) {
    if (type === 'expense') {
        return `-${amount} ₸`;
    } else if (type === 'income') {
        return `+${amount} ₸`;
    }
}

function categorySelect(categories) {
    const select = document.createElement('select');
    select.name = 'category';

    for (const category of categories) {
        const option = document.createElement('option');
              option.dataset.categoryId = category.id;
              option.textContent = `${category.name} (${category.type})`;

        select.appendChild(option);
    }

    return select;
}

export function modalWindow() {
    let domObject = document.createElement('div');
        domObject.className = 'modal-container active';
        domObject.innerHTML = `
            <div class="modal transaction-modal">
                <div class="title-block modal-title">
                    <div>Транзакция</div>
                    <div class="modal-close">
                        <i class="fa-solid fa-x"></i>
                    </div>
                </div>
                <div class="modal-content"></div>
            </div>
        `;

    return domObject;
};

export function categoryCreateForm() {
    let domObject = document.createElement('div');
        domObject.className = 'modal-container active';
        domObject.innerHTML = `
            <div class="form-container">
                <form name="add-category-form" action="../actions/category/create.php" method="post">
                    <div class="fields-row">
                        <div class="field-container">
                            <label for="category_name">Категория</label>
                            <input type="text" name="category_name" placeholder="Имя категории">
                        </div>
                        <div class="field-container">
                            <label for="category_type">Тип категории</label>
                            <select name="category_type">
                                <option value="income">Доход</option>
                                <option value="expense">Расход</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-send-button-container">
                        <input class="form-send-button" type="submit" value="Добавить">
                    </div>
                </form>
            </div>
        `;

    return domObject;
};

export function transactionCreateForm(data) {
    let domObject = document.createElement('form');
        domObject.id = 'create-transaction-form';
        domObject.innerHTML = `
            <div class="fields-row">
                <div class="field-container">
                    <label for="amount">Сумма</label>
                    <input type="text" name="amount" placeholder="Сумма">
                </div>
            </div>
            <div class="fields-row">
                <div class="field-container" id="date">
                    <label for="date">Дата</label>
                    <input type="date" name="date" placeholder="2026-01-01">
                </div>
            </div>
            <div class="fields-row">
                <div class="field-container">
                    <label for="description">Описание</label>
                    <input type="text" name="description" placeholder="Комментарий"></textarea>
                </div>
            </div>
            <div class="fields-row">
                <div class="field-container" id="category">
                    <label for="category">Категория</label>                                    
                </div>
            </div>
            <div class="fields-row">
                <div class="field-container" id="type">
                    <label for="type">Тип</label>
                    <select name="type">
                        <option value="income">Доход</option>
                        <option value="expense">Расход</option>
                    </select>
                </div>
            </div>
            <div class="form-send-button-container">
                <input class="form-send-button" type="submit" value="Добавить">
            </div>
        `;

        domObject.querySelector('#category').appendChild(categorySelect(data));

        return domObject;
}

export function categoryComponent(props) {
    let domObject = document.createElement('div');
        domObject.className = 'category';
        domObject.dataset.categoryId = props['id'];
        domObject.innerHTML = `
            <div class="category-name">
                <div class="category-filter-button">
                    <i class="fa-solid fa-car"></i>
                    <span>
                        ${props['name']} 10
                    </span>
                </div>
            </div>
        `;

    return domObject;
}

export function transaction(props) {
    let domObject = document.createElement('div');
        domObject.className = 'operation';
        domObject.dataset.transactionId = props.id;
        domObject.innerHTML = `
            <div class="operation-content">
                <div class="row space">
                    <div class="operation-date">${props.date}</div>
                    <div class="operation-time"></div>
                </div>
                <div class="row space">
                    <div class="operation-description">${props.description}</div>
                    <div class="operation-amount">${formatAmount(props.type, props.amount)}</div>
                </div>
                <div class="tags-container">
                    <div class="tag empty-tag">
                        <div class="tag-icon"></div>
                        <div class="tag-name">${props.category_name}</div>
                    </div>
                </div>
            </div>
        `;

        return domObject;
}

export function transactionEditForm(data) {
    let domObject = document.createElement('form');
        domObject.name = 'operation-edit-form';
        domObject.dataset.transactionId = data.id;
        domObject.innerHTML = `
            <div class="operation">
                <div class="operation-content">
                    <div class="row space">
                        <div class="operation-date">${data.date}</div>
                        <div class="operation-time"></div>
                    </div>
                    <div class="row space">
                        <div class="operation-description">${data.description}</div>
                        <div class="operation-amount">${formatAmount(data.type, data.amount)}</div>
                    </div>
                    <div class="tags-container">
                        <div class="tag empty-tag">
                            <div class="tag-icon"></div>
                            <div class="tag-name">${data.category_name}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-send-button-container">
                <input class="form-send-button delete-transaction-button" type="button" value="Удалить">
            </div>
        `;

        return domObject;
}