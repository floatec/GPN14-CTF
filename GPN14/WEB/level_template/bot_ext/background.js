(function() {
  var isEnabled = false;
  var noOfUrls = 5;
  var interval = 1000;
  var closeTimeout = 2000;
  var backendURL = "http://localhost/gpn/bot_backend/getURL.php?no=" + noOfUrls

  function receiveMessage(request, sender, sendResponse) {
    isEnabled = request.isStarted; 
  }

  chrome.runtime.onMessage.addListener(receiveMessage);

  function queryURLsFromBackend() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", backendURL, false);
    xhr.send();
    
    var urls = JSON.parse(xhr.responseText);
    return urls;
  }

  function testURLs(){
    if (isEnabled === false) {
      return;
    }

    var urls = queryURLsFromBackend();
    
    for(urlId in urls) {
      if (urls.hasOwnProperty(urlId)) {
        openURLinTab(urls[urlId]);
      }
    }
  }

  function openURLinTab(url) {
    function tabCallback(tab){
      function close() {
        chrome.tabs.remove(tab.id);
      }

      setTimeout(close, closeTimeout);
    };
    chrome.tabs.create({"url": url}, tabCallback);
  }

  setInterval(testURLs, interval);
})();
