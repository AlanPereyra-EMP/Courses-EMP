var test = document.querySelectorAll('.module');
console.log(test[1]);

for (var i = 0; i < test.length; i++) {
  test[i].addEventListener('click', dropdown, false);
}

function dropdown(){
  var content = this.querySelector('.content');
  var icon = this.querySelector('i');
  if (content.classList.contains('show')) {
    content.classList.remove('show');
    icon.classList.remove('rotated');
  } else {
    content.classList.add('show');
    icon.classList.add('rotated');
  }
}
