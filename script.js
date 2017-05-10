var input = document.querySelector('#enter');
var list = document.querySelector('.forlist');
var button = document.querySelector('button');
input.addEventListener('input',function () {
        document.querySelector('.preview-task').innerHTML = this.value;
});
document.querySelector('.prewiev-btn').addEventListener('click',function (e) {
    e.preventDefault();
   document.querySelector('.preview').classList.toggle('active');
});
document.querySelector('.preview').addEventListener('click',function (e) {
    e.preventDefault();
    document.querySelector('.preview').classList.toggle('active');
});
list.addEventListener('click',function (e) {
    const target = e.target;
    if(target.tagName == "BUTTON"){
        if(target.parentNode.dataset.state == 0)
            target.parentNode.dataset.state = 1;
        else
            target.parentNode.dataset.state = 0;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/addTask.php?&state=' + target.parentNode.dataset.state +'&id=' + target.parentNode.dataset.id );

        xhr.onreadystatechange = function() {
                if (xhr.readyState != 4) return;

                if (xhr.status != 200) {

                } else {

                }

            };

            xhr.send();
    }
    if(target.tagName == "TEXTAREA"){
        if(target.parentNode.dataset.state == 0)
            target.parentNode.dataset.state = 1;
        else
            target.parentNode.dataset.state = 0;
        target.onchange = function () {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/addTask.php?&text=' + target.parentNode.querySelector('.task').value
                +'&id=' + target.parentNode.dataset.id );
            xhr.onreadystatechange = function() {
                if (xhr.readyState != 4) return;

                if (xhr.status != 200) {
                    alert(xhr.status + ': ' + xhr.statusText);
                } else {
                    alert(xhr.responseText);
                }

            };
            xhr.send();
        };
    }
});
