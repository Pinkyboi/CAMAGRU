var select = document.querySelectorAll('#pseudo,#email,#password');

select.forEach(function(e){
    e.classList.add('error');
})