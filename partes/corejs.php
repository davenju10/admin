  <!--   Core JS Files   -->
  <script src="<?= $url_base ?>assets/js/core/popper.min.js"></script>
  <script src="<?= $url_base ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/chartjs.min.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/sweetalert2.all.min.js"></script>
  <script src="<?= $url_base ?>assets/js/core/alerts.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/all.min.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/firebase-app.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/firebase-analytics.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/firebase-messaging.js"></script>
  <script src="<?= $url_base ?>assets/js/plugins/axios.min.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.7/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.7/firebase-messaging-compat.js"></script>
  <script>
      const firebaseConfig = {
          apiKey: "AIzaSyCs4Ttvps9n7zLSRqYsC9_UKEc65yKOTbQ",
          authDomain: "push-a190b.firebaseapp.com",
          projectId: "push-a190b",
          storageBucket: "push-a190b.appspot.com",
          messagingSenderId: "108525001805",
          appId: "1:108525001805:web:cdf6d72f04ddee71509004",
          measurementId: "G-LKRQXQKYS4"
      };

      const app = firebase.initializeApp(firebaseConfig);
      // Retrieve Firebase Messaging object.
      const messaging = firebase.messaging();
      var registration;
      if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("firebase-messaging-sw.js")
          .then(function(reg) {
            registration = reg;
          }); 
      }

      // IDs of divs that display registration token UI or request permission UI.
      const tokenDivId = 'div_tokken';
      const permissionDivId = 'div_permiso';
    
      // Handle incoming messages. Called when:
      // - a message is received while the app has focus
      // - the user clicks on an app notification created by a service worker
      //   `messaging.onBackgroundMessage` handler.
      // messaging.onMessage((payload) => {
      //   console.log('Message received. ', payload);
      //   // Update the UI to include the received message.
      //   appendMessage(payload);
      // });
    
      function resetUI() {
        clearMessages();
        showToken('loading...');
        // Get registration token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        messaging.getToken({vapidKey: 'BCx1srUvOkBzqbf5GBh_-nkeosxEzrqSEWoEu2XKjsMVDfmIArmDKRQn6rXImC8OfsUewzxbqk8npnjJhTwoQxg', serviceWorkerRegistration : registration })
          .then((currentToken) => {
            console.log('Ya está aqui el tokken', currentToken);
            if (currentToken) {
              isTokenSentToServer()
              sendTokenToServer(currentToken);
              updateUIForPushEnabled(currentToken);
            } else {
              // Show permission request.
              console.log('No registration token available. Request permission to generate one.');
              // Show permission UI.
              updateUIForPushPermissionRequired();
              setTokenSentToServer(false);
            }
          }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
          });

      }
    
    
      function showToken(currentToken) {
        // Show token in console and UI.
        const tokenElement = document.querySelector('#token');
        tokenElement.textContent = currentToken;
      }
    
      // Send the registration token your application server, so that it can:
      // - send messages back to this app
      // - subscribe/unsubscribe the token from topics
      function sendTokenToServer(currentToken) {
        if (!isTokenSentToServer()) {
          console.log('Sending token to server...');
          // TODO(developer): Send the current token to your server.
          var formData = new FormData();
          formData.append('token',currentToken);
          axios.post('./php/guardarToken.php',formData).then( respuesta=>{
            setTokenSentToServer(true);
            notificationTitle = "👋 Bienvenido Enamorado digital 👋";
            notificationOptions = {
              badge: "https://admin.mifuturapp.com/assets/img/favicon/badge.png",
              body: "Ya puedes sacarle el máximo partido a tu webapp recibiendo notificaciones.",
              priority : "high",
              icon: "https://admin.mifuturapp.com/assets/img/logo/maskable2.png"
            };
            new Notification(notificationTitle,notificationOptions)
          }).catch( e=>{
            setTokenSentToServer(false);
          });
          
        } else {
          console.log('Token already sent to server so won\'t send it again ' +
              'unless it changes');
        }
      }
    
      function isTokenSentToServer() {
        return window.localStorage.getItem('sentToServer') === '1';
      }
    
      function setTokenSentToServer(sent) {
        window.localStorage.setItem('sentToServer', sent ? '1' : '0');
      }
    
      function showHideDiv(divId, show) {
        const div = document.querySelector('#' + divId);
        if (show) {
          div.style = 'display: visible';
        } else {
          div.style = 'display: none';
        }
      }
    
      function requestPermission() {
        console.log('Requesting permission...');
        Notification.requestPermission().then((permission) => {
          if (permission === 'granted') {
            console.log('Notification permission granted.');
            // TODO(developer): Retrieve a registration token for use with FCM.
            // In many cases once an app has been granted notification permission,
            // it should update its UI reflecting this.
            setTimeout(() => {
              resetUI();
            }, 2000);
          } else {
            console.log('Unable to get permission to notify.');
          }
        });
      }
    
      function deleteToken() {
        // Delete registration token.
        messaging.getToken().then((currentToken) => {
          messaging.deleteToken(currentToken).then(() => {
            console.log('Token deleted.');
            setTokenSentToServer(false);
            // Once token is deleted update UI.
            resetUI();
          }).catch((err) => {
            console.log('Unable to delete token. ', err);
          });
        }).catch((err) => {
          console.log('Error retrieving registration token. ', err);
          showToken('Error retrieving registration token. ', err);
        });
      }
    
      // Add a message to the messages element.
      function appendMessage(payload) {
        const messagesElement = document.querySelector('#messages');
        const dataHeaderElement = document.createElement('h5');
        const dataElement = document.createElement('pre');
        // dataElement.style = 'overflow-x:hidden;';
        dataHeaderElement.textContent = 'Received message:';
        dataElement.textContent = JSON.stringify(payload, null, 2);
        messagesElement.appendChild(dataHeaderElement);
        messagesElement.appendChild(dataElement);
      }
    
      // Clear the messages element of all children.
      function clearMessages() {
        const messagesElement = document.querySelector('#messages');
        while (messagesElement.hasChildNodes()) {
          messagesElement.removeChild(messagesElement.lastChild);
        }
      }
    
      function updateUIForPushEnabled(currentToken) {
        showHideDiv(tokenDivId, true);
        showHideDiv(permissionDivId, false);
        showToken(currentToken);
      }
    
      function updateUIForPushPermissionRequired() {
        showHideDiv(tokenDivId, false);
        showHideDiv(permissionDivId, true);
      }
      
      navigator.serviceWorker.onmessage = (event) => {
        console.log('Viene', event)
        const file = event.data.file;
        if(file){
          handleFiles(file)
        }else{
          appendMessage(event.data);
        }
      };

      function handleFiles(file) {
        var preview = document.getElementById('vista_foto');

        if (file.type.match('image.*')) {
          var img = document.createElement("img");
          img.classList.add("imagen_share");
          img.file = file;
          preview.appendChild(img);

          var reader = new FileReader();
          reader.onload = (function(aImg) { 
            return function(e) { 
              aImg.src = e.target.result;
              aImg.width = '100%';
              aImg.height = 'auto';  
            };
          })(img);
          reader.readAsDataURL(file);
        }else{
          function leerArchivo(file) {
            if (!file) {
              return;
            }
            var lector = new FileReader();
            lector.onload = function(e) {
              var contenido = e.target.result;
              preview.innerHTML = contenido;
            };
            lector.readAsText(file);
          }
          leerArchivo(file);
        }
      }
  </script>
  <!-- <script src="<= $url_base ?>assets/js/notificaciones.js"></script> -->
  <script src="<?= $url_base ?>assets/js/material-dashboard.js?v=3.1"></script>