<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBS24 Task</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <main>
        <section class="section task">
            <div class="task__container">
                <?php 
                    include_once 'inc/dbconfig.php';

                    $query = "SELECT * FROM `task_items`";
                    $result = $conn->query($query);
                ?>
                <div class="task__body">
                    <?php if($result->num_rows > 0) { 
                        $left = 20; $step = 320;?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <?php if($row['positionX'] != 0) $left = $row['positionX'];?>
                            <div class="task__item task__item-<?php echo $row['id'];?>" style="left:<?php echo $left;?>px;top:<?php echo $row['positionY'];?>px;background-color:<?php echo $row['color'];?>;">
                                <h2 class="task__title"><?php echo $row['title'];?></h2>
                                <p class="task__text"><?php echo $row['text'];?></p>
                                <div class="task__item-btns">
                                    <button class="task__edit" data-id="<?php echo $row['id'];?>">
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="30px" height="30px">    
                                            <path d="M 22.828125 3 C 22.316375 3 21.804562 3.1954375 21.414062 3.5859375 L 19 6 L 24 11 L 26.414062 8.5859375 C 27.195062 7.8049375 27.195062 6.5388125 26.414062 5.7578125 L 24.242188 3.5859375 C 23.851688 3.1954375 23.339875 3 22.828125 3 z M 17 8 L 5.2597656 19.740234 C 5.2597656 19.740234 6.1775313 19.658 6.5195312 20 C 6.8615312 20.342 6.58 22.58 7 23 C 7.42 23.42 9.6438906 23.124359 9.9628906 23.443359 C 10.281891 23.762359 10.259766 24.740234 10.259766 24.740234 L 22 13 L 17 8 z M 4 23 L 3.0566406 25.671875 A 1 1 0 0 0 3 26 A 1 1 0 0 0 4 27 A 1 1 0 0 0 4.328125 26.943359 A 1 1 0 0 0 4.3378906 26.939453 L 4.3632812 26.931641 A 1 1 0 0 0 4.3691406 26.927734 L 7 26 L 5.5 24.5 L 4 23 z"/>
                                        </svg>
                                    </button>
                                    <button class="task__save hide" data-id="<?php echo $row['id'];?>">
                                        <svg width="14" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 1L4.75 9 1 5.364" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <button class="task__remove" data-id="<?php echo $row['id'];?>">-</button>
                                </div>
                            </div>
                        <?php $left += $step; } ?>
                    <?php } ?>
                </div>
                <div class="task__btns">
                    <button id="task__add">
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="512px" height="512px">
                            <path d="M 7 2 L 7 48 L 34 48 A 1.0001 1.0001 0 0 0 34.035156 47.998047 C 35.704489 49.247954 37.766393 50 40 50 C 45.5 50 50 45.5 50 40 C 50 35.544504 47.045551 31.747182 43 30.464844 L 43 15.585938 L 29.414062 2 L 7 2 z M 9 4 L 28 4 L 28 17 L 41 17 L 41 30.050781 C 40.671173 30.017769 40.337148 30 40 30 C 34.5 30 30 34.5 30 40 C 30 42.249111 30.761674 44.324674 32.027344 46 L 9 46 L 9 4 z M 30 5.4140625 L 39.585938 15 L 30 15 L 30 5.4140625 z M 14 21 L 14 23 L 36 23 L 36 21 L 14 21 z M 14 27 L 14 29 L 36 29 L 36 27 L 14 27 z M 40 32 C 44.4 32 48 35.6 48 40 C 48 44.4 44.4 48 40 48 C 35.6 48 32 44.4 32 40 C 32 35.6 35.6 32 40 32 z M 14 33 L 14 35 L 25 35 L 25 33 L 14 33 z M 40 34.099609 C 39.4 34.099609 39 34.499609 39 35.099609 L 39 39 L 35.099609 39 C 34.499609 39 34.099609 39.4 34.099609 40 C 34.099609 40.6 34.499609 41 35.099609 41 L 39 41 L 39 44.900391 C 39 45.500391 39.4 45.900391 40 45.900391 C 40.6 45.900391 41 45.500391 41 44.900391 L 41 41 L 44.900391 41 C 45.500391 41 45.900391 40.6 45.900391 40 C 45.900391 39.4 45.500391 39 44.900391 39 L 41 39 L 41 35.099609 C 41 34.499609 40.6 34.099609 40 34.099609 z"/>
                        </svg>
                    </button>
                    <button class="task__timers">
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 64 64" width="512px" height="512px">
                            <path d="M 32 6 L 32 7 L 32 10 L 32 17 L 35 17 L 36.796875 10.53125 C 46.639041 12.721168 54 21.498331 54 32 C 54 44.15 44.15 54 32 54 C 19.85 54 10 44.15 10 32 C 10 25.654 12.690281 19.940781 16.988281 15.925781 L 13.960938 13.287109 C 9.0559375 18.016109 6 24.649 6 32 C 6 46.359 17.641 58 32 58 C 46.359 58 58 46.359 58 32 C 58 17.641 46.359 6 32 6 z M 20.978516 19.564453 L 19.564453 20.978516 L 28.056641 31.332031 A 4 4 0 0 0 32 36 A 4 4 0 0 0 32 28 A 4 4 0 0 0 31.335938 28.060547 L 20.978516 19.564453 z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </section>  
        <section class="section timers">
            <div class="timers__body">
                <span class="timers__close">+</span>
                <div class="timers__list">
                    <div class="timers__item">
                        <h2>Timer name</h2>
                        <div class="timer">
                            <div class="time" data-time="0" id="timer1">
                                <span class="hours">00</span>
                                <span class="separator">:</span>
                                <span class="minute">00</span>
                                <span class="separator">:</span>
                                <span class="second">00</span>
                                <span class="separator">:</span>
                                <span class="ms">00</span>
                            </div>
                            <div class="timer__btns">
                                <button class="timer__btn timer__start" data-id="1">Старт</button>
                                <button class="timer__btn timer__stop" data-id="1">Стоп</button>
                                <button class="timer__btn timer__remove">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timers__new">
                    <input type="text" id="newTimersName" class="form__input" placeholder="Навание нового таймера">
                    <button class="timers__add form__btn">Добавить</button>
                </div>
            </div>
        </section>
    </main>
    <div class="task__item task__empty">
        <h2 class="task__title"></h2>
        <p class="task__text"></p>
        <div class="task__item-btns">
            <button class="task__edit">
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="30px" height="30px">    
                    <path d="M 22.828125 3 C 22.316375 3 21.804562 3.1954375 21.414062 3.5859375 L 19 6 L 24 11 L 26.414062 8.5859375 C 27.195062 7.8049375 27.195062 6.5388125 26.414062 5.7578125 L 24.242188 3.5859375 C 23.851688 3.1954375 23.339875 3 22.828125 3 z M 17 8 L 5.2597656 19.740234 C 5.2597656 19.740234 6.1775313 19.658 6.5195312 20 C 6.8615312 20.342 6.58 22.58 7 23 C 7.42 23.42 9.6438906 23.124359 9.9628906 23.443359 C 10.281891 23.762359 10.259766 24.740234 10.259766 24.740234 L 22 13 L 17 8 z M 4 23 L 3.0566406 25.671875 A 1 1 0 0 0 3 26 A 1 1 0 0 0 4 27 A 1 1 0 0 0 4.328125 26.943359 A 1 1 0 0 0 4.3378906 26.939453 L 4.3632812 26.931641 A 1 1 0 0 0 4.3691406 26.927734 L 7 26 L 5.5 24.5 L 4 23 z"/>
                </svg>
            </button>
            <button class="task__save hide">
                <svg width="14" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 1L4.75 9 1 5.364" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="task__remove">-</button>
        </div>
    </div>
    <div class="popup">
        <div class="popup__body">
            <button class="popup__close">+</button>
            <h3>Добавить заметку</h3>
            <form action="#" name="add_task">
                <p>
                    <label for="#title">Заголовок</label>
                    <input type="text" id="title" name="title" class="form__input">
                </p>
                <p>
                    <label for="#text">Текст</label>
                    <textarea name="text" id="text" class="form__textarea"></textarea>
                </p>
                <p>
                    <label for="#color">Цвет</label>
                    <input type="color" name="color" id="color" class="form__input">
                </p>
                <button class="form__btn" id="addTaask">Создать</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="/js/main.js"></script>
</body>
</html>