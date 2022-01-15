<!--<p id="token"></p>-->
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyChWXNUmq4ckeU9LRCKNpv6STp87NU4V2A",
        authDomain: "scanncatch-b868d.firebaseapp.com",
        databaseURL: "https://scanncatch-b868d.firebaseio.com",
        projectId: "scanncatch-b868d",
        storageBucket: "scanncatch-b868d.appspot.com",
        messagingSenderId: "297080783938",
        appId: "1:297080783938:web:ce07ccbdad6ed5b0c9d9db",
        measurementId: "G-RJ6KC76RZQ"

    };
    firebase.initializeApp(firebaseConfig);
    const messaging=firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);
                // document.getElementById("token").innerHTML=token;
                
                localStorage.setItem("AdminFireBaseToken", token);
                
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
            })
    })
    IntitalizeFireBaseMessaging();
</script>
