self.addEventListener('push', function (event) {
    const options = {
        body: event.data ? event.data.text() : 'No payload',
        icon: 'icon.png',
        badge: 'badge.png'
    };

    event.waitUntil(
        self.registration.showNotification('Notification Title', options)
    );
});
