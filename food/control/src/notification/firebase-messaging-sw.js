// importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

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

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});