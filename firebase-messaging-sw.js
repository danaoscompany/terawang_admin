importScripts('https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.0.1/firebase-messaging.js');
var firebaseConfig = {
	apiKey: "AIzaSyCwA4RDinxYLVpw8R1oAt4X__2CMZfJVRY",
	authDomain: "fortune-teller-fbec0.firebaseapp.com",
	projectId: "fortune-teller-fbec0",
	storageBucket: "fortune-teller-fbec0.appspot.com",
	messagingSenderId: "439374704930",
	appId: "1:439374704930:web:f2874a1400c8cd6c88f57b"
};
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
messaging.onBackgroundMessage(function(payload) {
	console.log('[firebase-messaging-sw.js] Received background message ', payload);
	let type = parseInt(payload['data']['type']);
	const notificationTitle = payload['notification']['title'];
	const notificationOptions = {
		body: payload['notification']['body'],
		icon: '/firebase-logo.png'
	};
	self.registration.showNotification(notificationTitle,
		notificationOptions);
	getTrayNotifications();
});
