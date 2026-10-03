<?php
    session_start();
    
    if (empty($_SESSION['user_id'])) {
        header('Location: /signin.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="theme__light-theme">
    <div id="app">
        <div class="uti-btn">
            <i class="fa-solid fa-clipboard-list"></i>
        </div>
        
        <div class="header">
            <nav>
                <div class="navbar-button user">
                    <i class="fa-solid fa-user"></i>
                    <span class="username"></span>
                </div>
                <div class="navbar-button exit">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Выйти</span>
                </div>
            </nav>
        </div>

        <div class="main"> <!-- content-body -->
            <div class="content-container"> <!-- content-app -->
                <div class="metrics">
                    <div class="metrics_title">Ваш счёт:</div>
                    <div class="metrics_total">10 000$</div>
                </div>

                <div class="metrics-block">
                    <div class="m-block">
                        <div class="m-icon">
                            <i class="fa-solid fa-arrow-trend-down"></i>
                        </div>
                        <div>
                            <div class="">Расход</div>
                            <div class="total-amount ta-expenses"></div>
                        </div>
                    </div>
            
                    <div class="m-block">
                        <div class="m-icon">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div>
                            <div class="">Приход</div>
                            <div class="total-amount ta-incomes"></div>
                        </div>
                    </div>
                </div>

                <div class="title-block categories-count"></div>

                <div class="block">
                    <div class="categories">
                        <div class="categories-row">
                            <div class="category create-new-category">
                                <div class="category-name">
                                    <div class="category-filter-button">
                                        <i class="fa-solid fa-plus"></i>
                                        <span>
                                            Добавить категорию
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="title-block">
                    <div class="transactions-count"></div>
                    <div class="add-btn">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>

                <div class="block">
                    <div class="output-settings-wrapper">
                        <div class="output-settings inactive">
                            <div class="sort-button">
                                <i class="fa-solid fa-sliders"></i>
                            </div>
                            <div class="sort-button reverse">
                                <i class="fa-solid fa-sort"></i>
                                <span>Перевернуть список</span>
                            </div>
                            <div class="sort-button">
                                <i class="fa-solid fa-sort"></i>
                                <span>По сумме</span>
                            </div>
                        </div>
                        <div class="output-settings inactive">
                            <div class="sort-button">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>По дате</span>
                            </div>
                        </div>
                        <div class="output-settings inactive">
                            <div class="sort-button">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <div class="sort-button">
                                <i class="fa-solid fa-table-list"></i>
                                <span>Таблица</span>
                            </div>
                            <div class="sort-button">
                                <i class="fa-solid fa-table-cells-large"></i>
                                <span>Блоки</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <div class="operations-container table--active">
                        <div class="operations">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-content">
                "Finman" version 0.1.0; 
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/4e29a5a7e0.js" crossorigin="anonymous"></script>
    <script type="module" src="js/main.js"></script>
    <script src="js/modal.js"></script>
</body>
</html>