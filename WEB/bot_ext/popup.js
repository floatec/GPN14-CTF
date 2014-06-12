(function() {
  "use strict";

  function callBackgroundPage(isStarted) {
    chrome.runtime.sendMessage({"isStarted": isStarted}, function(response) {});
  }

  function bootstrap() {
    var btnStart = document.getElementById("startBtn");
    var btnStop  = document.getElementById("stopBtn");

    btnStart.onclick = function() {
      callBackgroundPage(true);
    } 
  
    btnStop.onclick = function() {
      callBackgroundPage(false);
    } 

    btnStart.disabled = false;
    btnStop.disabled = false;
  }

  window.addEventListener("load", bootstrap, false)

})();
