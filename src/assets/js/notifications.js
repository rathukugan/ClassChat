var initialQuestionN = 0;

function notificationSetUp() {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("Unfortunately this browser does not support notificaions :(");
  }

  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      if (permission === "granted") {
        //var notification = new Notification("Notifications activated!");
      }
    });
  }
  initialQuestionN = $('#questions_table tr').length;
}

function checkNotificaionNeeds(){
  var newQuestionN = $('#questions_table tr').length;

  if(initialQuestionN < newQuestionN){
    for(i = initialQuestionN; i < newQuestionN; i++){
        var question = $('#questions_table tr').eq(i).children("#student_question");
        if (Notification.permission !== 'denied') {
          Notification.requestPermission(function (permission) {
            if (permission === "granted") {
              var n = new Notification(question.html());
              setTimeout(n.close.bind(n), 10000); 
            }
          });
        }
    }
  }
  initialQuestionN = newQuestionN;
}