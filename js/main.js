document.addEventListener('DOMContentLoaded', function(){

    const requestURL = 'functions.php';

    let tasks = document.querySelectorAll('.task__item');

    if(tasks.length > 0) {
        tasks.forEach((task) => {
            dropTask(task);
            addActions(task);
        })
    }

    function dropTask(elem) {
        elem.onmousedown = function(e) {

            let moveLeft = 0;
            let moveTop = 0;

            let coords = getCoords(elem);
            let shiftX = e.pageX - coords.left;
            let shiftY = e.pageY - coords.top;


            elem.style.position = 'absolute';
            moveAt(e);

            elem.style.zIndex = 1000;

            function moveAt(e) {
                elem.style.left = e.pageX - shiftX + 'px';
                elem.style.top = e.pageY - shiftY + 'px';
                moveLeft = e.pageX - shiftX;
                moveTop = e.pageY - shiftY;
            }

            document.onmousemove = function(e) {
                moveAt(e);
            }

            elem.onmouseup = function() {
                document.onmousemove = null;
                elem.onmouseup = null;

                let data = "action=changePosition&x=" + moveLeft +
                    "&y=" + moveTop +
                    "&id=" + elem.querySelector('.task__remove').dataset.id;
                const xhr = new XMLHttpRequest();
                xhr.open('POST', requestURL, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function(){
                }
                xhr.send(data);

            }
            
            elem.ondragstart = function() {
                return false;
            };

            function getCoords(elem) { 
                let box = elem.getBoundingClientRect();
                return {
                    top: box.top + pageYOffset,
                    left: box.left + pageXOffset
                };
            }



        }
    }

    function addActions(elem) {

        let remove =  elem.querySelector('.task__remove');

       remove.addEventListener('click', function(btn){
            let id =remove.dataset.id;

            let data = "action=removeTask&id=" + id;
            const xhr = new XMLHttpRequest();
            xhr.open('POST', requestURL, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function(){
                remove.parentElement.parentElement.style.transform = 'scale(0)';
            }
            xhr.send(data);
        })

        elem.querySelector('.task__edit').addEventListener('click', function(btn){

            let edit = elem.querySelector('.task__edit');
            let title = elem.querySelector('.task__title');
            let text = elem.querySelector('.task__text');
            let save = elem.querySelector('.task__save');

            title.setAttribute('contentEditable', true);
            text.setAttribute('contentEditable', true);
            text.focus();

            edit.classList.add('hide');
            save.classList.remove('hide');

        })

        elem.querySelector('.task__save').addEventListener('click', function(){
            let id = elem.querySelector('.task__save').dataset.id;
            let title = elem.querySelector('.task__title');
            let text = elem.querySelector('.task__text');
            let data = "action=editTask&title='"+title.innerText+"'&text='"+text.innerText+"'&id="+id;
            let edit = elem.querySelector('.task__edit');
            let save = elem.querySelector('.task__save');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', requestURL, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){

                title.removeAttribute('contentEditable');
                text.removeAttribute('contentEditable');

                edit.classList.remove('hide');
                save.classList.add('hide');
            }

            xhr.send(data);
        })
    }

    let openPopup = document.querySelector('#task__add');

    openPopup.addEventListener('click', function(){
        document.querySelector('.popup').classList.add('showed');
    })

    let closePopup = document.querySelector('.popup__close');

    closePopup.addEventListener('click', function(){
        document.querySelector('.popup').classList.remove('showed');
    })

    let addTaskBtn = document.querySelector('#addTaask');

    addTaskBtn.addEventListener('click', function(e){
        e.preventDefault();
        let formData = new FormData(document.forms.add_task);
        formData.append("action", "addTask");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", requestURL, true);
        xhr.send(formData);

        xhr.onload = function(){
            let id = xhr.response;
            let clearTask = document.querySelector('.task__empty');

            let clone = clearTask.cloneNode(true);
            clone.classList.remove('task__empty');
            clone.classList.add('task__item-' + id);
            clone.querySelector('.task__remove').dataset.id = id;
            //clone.querySelector('.task__edit').dataset.id = id;
            clone.querySelector('h2').innerHTML = formData.get('title');
            clone.querySelector('p').innerHTML = formData.get('text');
            clone.style.backgroundColor = formData.get('color');
            document.querySelector('.task__body').appendChild(clone);

            dropTask(clone);
            addActions(clone);
            
            document.querySelector('.popup').classList.remove('showed');
            document.add_task.reset();
        }
    })



    // TIMERS

    let timerClose = document.querySelector('.timers__close');
    let timerBody = document.querySelector('.timers');
    let timersOpen = document.querySelector('.task__timers');
    
    timersOpen.addEventListener('click', function(){
        timerBody.classList.add('showed');
    })

    timerClose.addEventListener('click', function(){
        timerBody.classList.remove('showed');
    })
    
    class MyTimer {

        constructor( time, timerId ) {
            this.config = {
                state: false,
                ms: time.getMilliseconds(),
                second: time.getSeconds(),
                minute: time.getMinutes(),
                hours: time.getUTCHours(),
                step: 1000 / 60,
            }
            this.timerID = timerId
        }
        
        start() {
            // start timer
            this.config.state = true
            this.count()
        }
        
        stop() {
            this.config.state = false
            this.count()
        }
        
        count() {
            if( this.config.state == true )  {
                
                this.timerID = setInterval( () => {
                this.config.now += 1;

                // show "now" in div element
                $(".firstTimerValue").text( this.config.now );
                
                }, this.config.step )
                
            } else if( this.config.state == false ) {

                clearInterval( this.timerID )

            }
        }
    }

    let timerStart = document.querySelectorAll('.timer__start');
    
    if(timerStart.length > 0) {
        timerStart.forEach((start) => function(){
            start.addEventListener
        })
    }

});