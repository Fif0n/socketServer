<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Testing websocket</title>
  </head>
  <body>
    <button onclick="testWebSocket()">TEST</button>
    <br />
    <button onclick="doSend('7')">Send 7</button>
    <button onclick="doSend('0')">Send 0</button>
    <button onclick="doSend('1')">Send 1</button>
    <button onclick="doSend('Hi')">Send Hi</button>
    <button onclick="doSend('Hello')">Send Hello</button><br />
    <button onclick="doSend('DISCONNECT')">DISCONNECT SEND</button><br />
    <button onclick="websocket.close()">Close</button>

    <script>
      var wsUri = "ws://127.0.0.1:27015"; // "wss://echo.websocket.org/";
      var output;

      function testWebSocket() {
        websocket = new WebSocket(wsUri, "lws-minimal"); //lws-minimal BARDZO WAŻNE: lws-minimal oznacza naszą bibliotekę z C++ i jej protokół

        websocket.onopen = function (evt) {
          onOpen(evt);
        };
        websocket.onclose = function (evt) {
          onClose(evt);
        };
        websocket.onmessage = function (evt) {
          onMessage(evt);
        };
        websocket.onerror = function (evt) {
          onError(evt);
        };
      }

      function onOpen(evt) {
        console.log("CONNECTED");
      }

      function onClose(evt) {
        console.log("DISCONNECTED");
      }

      function onMessage(evt) {
        console.log("RESPONSE: " + evt.data + "");
        if (evt.data == "DISCONNECT") websocket.close();
      }

      function onError(evt) {
        console.log("ERROR: " + JSON.stringify(evt));
      }

      function doSend(message) {
        console.log("SENT: " + message);
        websocket.send(message);
      }
    </script>
  </body>
</html>