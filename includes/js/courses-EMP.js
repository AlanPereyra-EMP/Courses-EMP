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

var videoEmp = document.getElementById('courses-emp-lesson-video');
if(videoEmp){
  var topics = document.getElementById('topic-height');
  var height = videoEmp.offsetHeight;
  topics.style.maxHeight = (height-20)+'px';
  topics.classList.add('overflow-auto', 'border-30px');
}
